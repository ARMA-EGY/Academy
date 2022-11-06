
            


        @foreach ($photos as $photo)

        <div class="col-md-4 edit-section parent">
            <button class="btn btn-danger btn-sm edit2 remove_item" data-id="{{$photo->id}}" data-url="{{route('remove-slider')}}">
              <i class="fas fa-trash-alt text-white"></i>
            </button>
            <a data-fancybox="gallery" href="{{asset('storage/'.$photo->image)}}">
                <img  class="img-fluid rounded" src="{{asset('storage/'.$photo->image)}}">
            </a> 
          </div>
        
    @endforeach
