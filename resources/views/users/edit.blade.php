@extends('layouts.app')

@section('title')
Edit | User Info {{ $user->name }} 
@endsection

@section('stylesheets')
<style type="text/css">
#map-canvas {
  width: 300px;
  height: 250px;
  border: 1px solid blueviolet;
}
</style>
@endsection

@section('content')

<section class="hero">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title p-l-10 p-t-10 p-b-10">Edit My Account</h3>
            </div>
            <div class="card-content ">
              <form action="{{ route('user.update', Auth::user()->username) }}" method="POST" class="p-b-20" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="columns">
                  <div class="column is-7">

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Account Type</label>
                      </div>

                      <div class="field-body">
                        <b-field>
                          <div class="select">
                            <select class="is-fullwidth" name="is_company" required>
                              <option value="0" {{ $user->is_company == 0 ? 'selected': '' }}>As a user</option>
                              <option value="1" {{ $user->is_company == 1 ? 'selected': '' }}>As a Company</option>
                            </select>
                          </div>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->


                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Name</label>
                      </div>

                      <div class="field-body">
                        <b-field>
                          <b-input placeholder="Name" name="name" icon="user" required maxlength=30 value="{{ $user->name }}"></b-input>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->




                    <div class="field is-horizontal">

                      <div class="field-label is-normal">
                        <label class="label">Email</label>
                      </div>
                      <div class="field-body">
                        <b-field>
                          <b-input placeholder="Primary Email" type="email" name="email" icon="envelope" is-expanded="true" required  value="{{ $user->email }}"></b-input>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->


                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Phone No</label>
                      </div>

                      <div class="field-body">
                        <div class="field-body">
                          <b-field>
                            <b-input placeholder="01951233084" type="text" name="phone" icon="phone" is-expanded="true" required  value="{{ $user->phone }}"></b-input>
                          </b-field>
                        </div> <!--End Field Body -->
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->


                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Division / District</label>
                      </div>

                      <div class="field-body">
                        <b-field>
                          <select class="is-fullwidth input" name="division_id" required>
                            @foreach ($divisions as $division)
                            @if ($division->id == $user->division_id)
                            <option value="{{ $division->id }}" selected>{{ $division->name }}</option>
                            @else
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endif

                            @endforeach
                          </select>
                        </b-field>
                        <b-field>
                          <select class="is-fullwidth input" name="district_id" required>
                            @foreach ($districts as $district)
                            @if ($district->id == $user->district_id)
                            <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                            @else
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endif
                            
                            @endforeach
                          </select>
                        </b-field>

                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->


                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Street</label>
                      </div>

                      <div class="field-body">
                        <b-field>
                          <b-input placeholder="Street Address" type="text" name="street_address" icon="address-book" maxLength=100 value="{{ $user->street_address }}"></b-input>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Password</label>
                      </div>

                      <div class="field-body">
                        <b-field>
                          <b-input placeholder="Password" type="password" name="password" icon="lock" required password-reveal></b-input>
                        </b-field>
                        <b-field>
                          <b-input placeholder="Confirm Password" type="password" name="password_confirmation" icon="lock" required password-reveal></b-input>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->



                    <div class="field-body is-centered">
                      <p class="control is-centered">
                        <button class="button is-primary" type="submit">Register</button>
                      </p>
                    </div> <!--End Field Body -->
                  </div>
                  <div class="column is-5" style="border-left: 1px solid gray">

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Website (Optional)</label>
                      </div>
                      <div class="field-body">
                        <b-field>
                          <b-input placeholder="Primary Email" type="url" name="website" icon="rss_square" is-expanded="true" required  value="{{ $user->website }}"></b-input>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Profile (Previous)</label>
                      </div>
                      <div class="field-body">
                        <img src='{{ ($user->image != null) ? "images/users/$user->image" : "" }}' style="width: 100px; border: 1px solid blueviolet;">
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Profile(New) (Optional)</label>
                      </div>
                      <div class="field-body">
                        <b-field>
                          <b-input type="file" name="website" icon="rss_square" is-expanded="true"></b-input>
                        </b-field>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Location (Search)</label>
                      </div>
                      <div class="field-body">
                        <b-field>
                          <b-input type="text" id="searchmap" name="searchmap" icon="search"  is-expanded="true"></b-input>
                        </b-field>
                        {{-- <input type="text" id="searchmap" /> --}}
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->

                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Location (Optional)</label>
                      </div>
                      <div class="field-body">
                        <div id="map-canvas"></div>
                      </div> <!--End Field Body -->
                    </div> <!--End Field Horizontal-->


                  </div>
                </div>

              </form> <!--End User Registration Form -->

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>



@endsection


@section('scripts')

<script>
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
      center: 
      {
        lat: 22.464814,
        lng: 90.3813789
      },
      zoom: 15
    });

 

    marker = new google.maps.Marker({
      position: 
      {
        lat: 22.464814,
        lng: 90.3813789
      },
      map: map,
      draggable: true
    });

   var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
   google.maps.event.addListener(searchBox, 'places_changed' function(){
      var places = searchBox.getPlaces();
      var bounds = new google.maps.LatLngBounds();

      for ($i = 0; $place = $places[$i] ; $i++)
      {
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location);
        
      }
      map.fitBounds(bounds);
      map.setZoom(15);
      
   })


  }

  

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4f01TWPmCIDs9ZbZf7YJyaQo6JhttWRE&callback=initMap" async defer></script>


<script type="text/javascript">
  const app = new Vue({
    el: '#app',
    data:{

    },
    methods:{

    }
  });
</script>
@endsection
