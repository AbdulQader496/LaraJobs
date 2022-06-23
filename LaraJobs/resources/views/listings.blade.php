<h1>

{{$heading}}

</h1>

@foreach($listings as $listing)
    
    <h2>
        <a href="/listings/{{$listings['id']}}">{{$listings['title']}}</a>
    </h2>
    <p>{{ $listings['description'] }}</p>

@endforeach 