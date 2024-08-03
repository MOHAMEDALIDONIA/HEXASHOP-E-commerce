<div class="col-md-12 col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">To do list</h4>
        <form wire:submit.prevent="add">
          <div class="add-items d-flex">
            <input type="text" class="form-control todo-list-input text-white" wire:model="task" placeholder="enter task..">
            @error('task') <small class="text-danger">{{$message}}</small>   @enderror
            <button class="add btn btn-primary" type="submit">Add</button>
          </div>
        </form>
     
        <div class="list-wrapper">
          <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
           @foreach ($tasks as $item)
            
              <li>
                <div class="form-check form-check-primary">
                  <div class="col-8 col-sm-12 col-xl-8 my-auto">
                    <h6 class="text-white font-weight-normal">
                    
                      {{$item->task}}</h6>
                  </div>
                
                    
                  
                </div>
                <div class="col">
                  <button type="button" wire:loading.attr="disabled" wire:click="remove({{$item->id}})" class="btn btn-danger btn-sm float-end">
                      <span wire:loading.remove wire:target="remove({{$item->id}})">
                          <i class="mdi mdi-basket-fill"></i> Remove
                      </span>
                      <span wire:loading wire:target="remove{{$item->id}})">
                          <i class="mdi mdi-basket-fill"></i> Removing..
                      </span>
                  </button>
                </div>
              </li>
              
           @endforeach 
           
        
          </ul>
        </div>
      </div>
    </div>
  </div>
