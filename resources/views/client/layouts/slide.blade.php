<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $i = 0?>
                @foreach($list_slide as $slide)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}}"
                        @if($i == 0)
                        class="active"
                            @endif>
                    </li>
                    <?php $i++?>
                @endforeach
            </ol>
            <div class="carousel-inner">
                <?php $i = 0?>
                @foreach($list_slide as $slide)
                    @if($i == 0)
                        <div class="item active">
                            <img class="slide-image" src="upload/slide/{{$slide->Hinh}}" alt="{{$slide->NoiDung}}">
                        </div>
                    @else
                        <div class="item">
                            <img class="slide-image" src="upload/slide/{{$slide->Hinh}}" alt="{{$slide->NoiDung}}">
                        </div>
                    @endif
                    <?php $i++?>
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>