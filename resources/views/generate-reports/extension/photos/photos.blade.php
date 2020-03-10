{{-- <div class="row text-center text-lg-left">
    @foreach($photos->extensionReportPhotos as $photo)
        <div class="col-lg-3 col-md-4 col-6">
          <a href="{{ $photo->url }}" target="_blank" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="/public_files/gallery/{{ $photo->photo }}">
          </a>
        </div>
    @endforeach
  </div> --}}

  @foreach($photos->extensionReportPhotos as $photo)
    <a href="{{ $photo->url }}" target="_blank" class="d-block mb-4 h-100 xol-ms-6">
        <img class="img-responsive img-thumbnail" src="{{ $photo->url }}">
    </a>
 @endforeach