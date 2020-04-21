<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Njuškalo favorite ads tracker</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
          crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

    </style>
</head>
<body>

<div class="container-fluid">

    <div class="col-12">

        <div class="jumbotron">
            <h1 class="display-4">Njuškalo tracker</h1>
            <p class="lead">track price changes of your favorite ads</p>
        </div>

        <form method="POST" action="{{ url('/') }}">

            @csrf

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" id="code" class="form-control" readonly value="items=[],regex=/([0-9]+.[0-9])\w+/,jQuery.each(jQuery('.entity-table--FavoriteAds tbody tr'),function(t,e){e={id:jQuery(e).find('td.u-text-center').text().trim(),title:jQuery(e).find('.entity-title a').text(),link:jQuery(e).find('.entity-title a').attr('href'),priceString:jQuery(e).find('.entity-meta p').text().trim(),price:null,image:jQuery(e).find('.entity-thumbnail img').attr('src')};result=regex.exec(e.priceString),null!=result&&(e.price=result[0],items.push(e))}),console.table(items),console.log(JSON.stringify(items));">
                <small class="form-text text-muted">Copy this code block and execute it in your Web browser console <a href="https://www.njuskalo.hr/moje-njuskalo/spremljeni-oglasi/" target="_blank" rel="nofollow">here</a></small>
            </div>

            <div class="form-group">
                <label for="json">JSON String</label>
                <input name="json" id="json" class="form-control" required>
                <small class="form-text text-muted">Paste JSON string from your Web browser console here</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </div>

        </form>

    </div>

    <div class="col-12">
        <div class="row">
            @foreach($items as $item)
                <div style="width: 198px; margin: 5px">
                    <div class="card h-100">
                        <a href="https://njuskalo.hr{{ $item->link }}" target="_blank" rel="noopener">
                            <img src="{{ $item->image }}" height="120" class="card-img-top" alt="{{ $item->title }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ number_format($item->price, 2, ',', '.') }} €</b></h5>
                            @if(count($item->prices) > 1)
                                <p class="text-white bg-dark text-center">Sniženo!</p>
                                <ul class="list-unstyled">
                                    @foreach($item->prices as $price => $date)
                                        @if($loop->last) @continue @endif
                                        <li class="text-danger" title="{{ $date }}"><b>{{ number_format($price, 2, ',', '.') }} €</b></li>
                                    @endforeach
                                </ul>
                            @endif
                            <p class="card-text">{{ $item->title }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div hidden>items = [];
        regex = /([0-9]+.[0-9])\w+/
        jQuery.each(jQuery('.entity-table--FavoriteAds tbody tr'), function(index, item) {
          var item = {
            id: jQuery(item).find('td.u-text-center').text().trim(),
            title: jQuery(item).find('.entity-title a').text(),
            link: jQuery(item).find('.entity-title a').attr('href'),
            priceString: jQuery(item).find('.entity-meta p').text().trim(),
            price: null,
            image: jQuery(item).find('.entity-thumbnail img').attr('src'),
          };
          result = regex.exec(item.priceString);
          if (result == null) {
            return;
          }
          item.price = result[0]
          items.push(item)

        });
        console.table(items)
        console.log(JSON.stringify(items));
    </div>
</div>
</body>
</html>
