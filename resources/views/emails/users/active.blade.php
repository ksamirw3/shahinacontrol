<html>
    <head>
        
    </head>
    <body>
        <div>
           Dear {{$row->username}},
           thankes for register with us .
           please active your acount to be abel to use our feature.
           <a href="{{url('/')}}/active?t={{$row->active_token}}">Active</a>
        </div>
    </body>
</html>