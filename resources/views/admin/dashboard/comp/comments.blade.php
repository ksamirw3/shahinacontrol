

<!-- USERS ONLINE SECTION -->
<h4 class="centered mt">{{__('admin.Latest 5 Reviews')}}</h4>
<!-- First Member -->


@foreach($last_comments as $last)
<div class="desc">
    <div class="thumb">
        <img class="img-circle" src="uploads/<?php echo $last['image'];?>" width="35px" height="35px" align="">
    </div>
    <div class="details">
        <p><a href="#">{{ $last['name'] }}</a><br/>
            <muted>{{ $last['comment'] }}</muted>
        </p>
    </div>
</div>
@endforeach