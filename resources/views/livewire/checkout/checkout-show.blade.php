<div style="margin-top:100px;">
    <section class="delivery-info pt-5 pb-5" >

        <div class="container" style="border: 5px solid black;">
          <form wire:submit="save" >
            <h2 class="title"> Checkout</h2>
            @if (session()->has('message'))
                <div class="alert alert-danger">
                  {{ session('message') }}
              </div>
                
            @endif
            <div class="row">
               <h4>items order :({{$orderitem}}) and total price :(${{$totalprice}})</h4>
            </div>
            <hr>
          
            <h4 class="form-title">Client's Information</h4>
            <div class="row">
             
              <div class="col-md-12">
                <div class="form-group">
                  <label>Full Name</label>
                  
                   <input type="text" wire:model.defer="fullname" class="form-control" placeholder="Enter Full Name">
                   @error('fullname') <small class="text-danger">{{$message}}</small>   @enderror
                  <div>
                   
                </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" wire:model.defer="phone" value="{{$fullname}}" class="form-control" placeholder="Enter phone number">
                  @error('phone') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" wire:model.defer="email" class="form-control" placeholder="Enter Your Email">
                  @error('email') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Full Address</label>
                  <textarea wire:model.defer="address" class="form-control text-area" rows="3"  placeholder="Enter full address to send order"> </textarea>
                  @error('address') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pin-Code(Zip-Code)</label>
                  <input type="text" wire:model.defer="pin_code" class="form-control" placeholder="Eg:Enter pin-code">
                  @error('pin_code') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              @if ($user->DiscountCode()->count() > 0)
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Discount Code</label>
                      <input  readonly value="{{$user->DiscountCode->discount_code}}" >
                    
                  
                    </div>
                  </div> 
              @endif
             
            </div>
            <h4 class="form-title">Delivery Information</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Location Type</label>
                  <select class="form-control" wire:model.defer="location_type">
                    <option value="" selected>__</option>
                    <option value="house" >House</option>
                    <option value="office">Office</option>
                    <option value="school">School</option>
                    <option value="university">University</option>
                    <option value="hospital">Hospital</option>
                    <option value="hotel">hotel</option>
                    <option value="work shop">work shop</option>
                    <option value="company">Company</option>
                  </select>
                  @error('location_type') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                   <label>Delivery Date</label>
                   <input wire:model.defer="delivery_date" type="date" class="form-control">
                   @error('delivery_date') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Preferred Delivery Time</label>
                  <select class="form-control" wire:model.defer="prefer_delivery_time">
                    <option value="" selected>__</option>
                    <option value="Morning(7am - 10am)" > Morning (7am - 10am)</option>
                    <option value="Anytime(7am - 8pm)">Anytime (7am - 8pm)</option>
                    <option value="Noon(12pm - 5pm)">Noon (12pm - 5pm)</option>
                    <option value="Evening(5pm - 8pm)">Evening (5pm - 8pm)</option>
                    <option value="Midnight(12am - 7am)">Midnight(12am - 7am)</option>
                  </select>
                  @error('prefer_delivery_time') <small class="text-danger">{{$message}}</small>   @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Delivery Instructions</label>
                  <textarea wire:model.defer="delivery_instructions" class="form-control text-area" placeholder="Ex: Ring the bell once & wait"></textarea>
                 
                </div>
              </div>
            </div>
      

              
              <h4 class="form-title">Payment Method</h4>
              
                <div class="col-md-12 flex space-between">
                    <a href="{{url('/payment-online-view')}}" class="btn btn-primary btn-cart" role="button" id="buttontem" aria-pressed="true">Online Payment</a>
                   
                    <button class="btn btn-primary btn-cart"id="buttontem"  type="submit">	Cash ON Delivery</button>
                </div>
              
            
            </div>
          </form>
        </div>
      </section>
</div>
