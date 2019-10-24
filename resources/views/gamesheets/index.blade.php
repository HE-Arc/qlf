<h1>Gamesheets</h1>

@foreach($gamesheets as $gs)
<div>
    <p>Name: {{$gs->name}}</p>
    <p>Template: {{$gs->template}}</p>
    <p>Downloads: {{$gs->downloads}}</p>
</div>
@endforeach
