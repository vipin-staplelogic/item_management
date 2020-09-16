<!DOCTYPE html>
<html>
  <style type="text/css">
  </style>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <input name="_token" value="{{ csrf_token() }}" type="hidden">
    <title>
      Manage Items
    </title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <div class="loader-sec" style="display: none;">
    <div class="loader"></div>
  </div>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav justify-content-end w-100">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="checkbox-sec">
        <h1 style="margin-bottom: 50px;">Items Management Page</h1>
        <div class="row justify-content-center align-items-center mb-4">
          <div class="col-sm-5">
              <input type="text" id="fname" name="fname" class="item_name" placeholder="Enter item name and click add" autocomplete="off">
              <button name="addItem" class="addItem" id="addItem" style="cursor: pointer;">Add</button>
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-5">
             <h1>Selected Items</h1>
          </div>
          </div>

          <div class="row justify-content-center align-items-center">
          <div class="outer-box col-sm-5">  

            <div class=" box-sec itemDiv1">
               @if(isset($leftItems) && !empty($leftItems))
                @foreach($leftItems as $key =>$value)
                  <label class="cstm-check leftItem-{{$value['id']}}">{{$value['title']}}
                    <input type="checkbox" name="leftItemCheckBox" class="leftItemCheckBox" id="leftItemCheckBox" value="{{$value['id']}}">
                    <span class="checkmark"></span>
                  </label>

                @endforeach
              @else
                <p class="noItemFound"> No item found</p>
              @endif
            </div>
          </div>

          <div class="col-sm-2 button-sec">
            <button name="moveLeftToRight" value=">" class="moveLeftToRight" id="moveLeftToRight">></button><br>
            <button name="moveRightToLeft" value="<" class="moveRightToLeft" id="moveRightToLeft"><</button>
          </div>
          <div class="col-sm-5">
           <p class="rightBoxError" style="position: absolute; margin-top: -30px; color: red;"></p> 
            <div class="box-sec itemDiv2">

              @if(isset($rightItems) && !empty($rightItems))
                @foreach($rightItems as $key =>$value)
                  <label class="cstm-check rightItem-{{$value['id']}}">{{$value['title']}}
                    <input type="checkbox"  name="rightItemCheckBox" class="rightItemCheckBox" id="rightItemCheckBox" value="{{$value['id']}}">
                    <span class="checkmark"></span>
                  </label>
                @endforeach
              @else
                <p class="noItemFound"> No item found</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/test.js') }}"></script>
    <script type="text/javascript">
      var site_url = "{{url('/')}}";
    </script>
  </body>
</html>