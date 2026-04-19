@foreach($cameras as $cam)
  <h3>{{ $cam->nama }}</h3>
  <video width="400" controls autoplay>
    <source src="{{ $cam->stream_url }}">
  </video>
@endforeach