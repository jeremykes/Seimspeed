@extends('layouts.app')

@section('content')
      <div class="col-md-12" style="padding-bottom:50px">
        <div class="container">
          <div class="col-md-4">
            <h2>Some heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
          </div>
          <div class="col-md-4">
            <h2>Some heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
          </div>
          <div class="col-md-4">
            <h2>Some heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
          </div>
        </div>
      </div>


      <div class="container">
        <div class="col-md-3">
          <div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active" style="width:50%"><a href="#cars" aria-controls="cars" role="tab" data-toggle="tab">Cars</a></li>
              <li role="presentation" style="width:50%"><a href="#parts" aria-controls="parts" role="tab" data-toggle="tab">Parts</a></li>
            </ul>

            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="cars">
                <div class="panel panel-default" style="border-radius:0">
                  <div class="panel-body">
                    <form>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" checked> All &nbsp;&nbsp;
                        </label>
                        <label>
                          <input type="checkbox"> Sales &nbsp;&nbsp;
                        </label>
                        <label>
                          <input type="checkbox"> Rentals &nbsp;&nbsp;
                        </label>
                        <label>
                          <input type="checkbox"> Auctions &nbsp;&nbsp;
                        </label>
                        <label>
                          <input type="checkbox"> Tenders &nbsp;&nbsp;
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Make</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Start typing make...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Model</label>
                        <input type="text" class="form-control" id="exampleInputtext1" placeholder="Start typing model...">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputtext1">Body Type</label>
                        <input type="text" class="form-control" id="exampleInputtext1" placeholder="Start typing body type...">
                      </div>
                      <div class="form-group col-md-6" style="padding-right:5px;padding-left:0">
                        <label for="exampleInputtext1">Min Price</label>
                        <input type="text" class="form-control" id="exampleInputtext1" placeholder="Min price">
                      </div>
                      <div class="form-group col-md-6" style="padding-right:0;padding-left:5px">
                        <label for="exampleInputtext1">Max Price</label>
                        <input type="text" class="form-control" id="exampleInputtext1" placeholder="Max price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputtext1">Location</label>
                        <input type="text" class="form-control" id="exampleInputtext1" placeholder="Start typing location...">
                      </div>
                      <button type="submit" class="btn btn-default">Search</button>
                    </form>
                  </div>
                </div>
                  
              </div>
              <div role="tabpanel" class="tab-pane" id="parts">
                  <div class="panel panel-default" style="border-radius:0">
                    <div class="panel-body">
                      <form>
                        <div class="form-group">
                          <label for="exampleInputEmail1">For make</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Start typing make...">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">For model</label>
                          <input type="text" class="form-control" id="exampleInputtext1" placeholder="Start typing model...">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputtext1">For body type</label>
                          <input type="text" class="form-control" id="exampleInputtext1" placeholder="Start typing body type...">
                        </div>
                        <div class="form-group col-md-6" style="padding-right:5px;padding-left:0">
                          <label for="exampleInputtext1">Min Price</label>
                          <input type="text" class="form-control" id="exampleInputtext1" placeholder="Min price">
                        </div>
                        <div class="form-group col-md-6" style="padding-right:0;padding-left:5px">
                          <label for="exampleInputtext1">Max Price</label>
                          <input type="text" class="form-control" id="exampleInputtext1" placeholder="Max price">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputtext1">Location</label>
                          <input type="text" class="form-control" id="exampleInputtext1" placeholder="Start typing location...">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                      </form>
                    </div>  
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <!-- tender panel -->
          <div class="panel panel-primary">
            <div class="panel-body" style="border-radius:0">
              <div class="col-md-4">
                <img class="img-responsive" src="imgs/c.png">
              </div>
              <div class="col-md-8">
                <p><strong>PNG Air Services</strong> <span class="pull-right" style="font-size:10px;color:gray">8 days ago&nbsp;&nbsp;<span class="label label-primary" style="font-size:15px">tender</span></span></p>
                <p>First ever car for sale. The directive, as the name implies, defines a section of content, while
the directive is used to display the contents of a given section.</p>
                <p><span style="color:gray;font-size:11px">3 comments <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">78 tenders <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">40 tailing <i class="fa fa-eye"></i></span></p>
                <p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;">comment</a>&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;">tail</a></span><span class="pull-right"></span></p>
              </div>
            </div>
          </div>

          <!-- tender group panel -->
          <div class="panel panel-primary">
            <div class="panel-heading">
              <strong>BSP Finance</strong><span class="pull-right">Tender Group</span>
            </div>
            <div class="panel-body" style="border-radius:0">
              <div class="col-md-4">
                <img class="img-responsive" src="imgs/mycar.png">
              </div>
              <div class="col-md-8">
                <p><strong>Asset Discard</strong><span class="pull-right" style="font-size:10px;color:gray">2 days ago</span></p>
                <p>First ever car for sale. The directive, as the name implies, defines a section of content, while
the directive is used to display the contents of a given section.</p>
                <p><span style="color:gray;font-size:11px">7 comments <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">23 offers <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">243 tailing <i class="fa fa-eye"></i></span></p>
                <p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;">comment</a>&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;">tail</a></span><span class="pull-right"></span></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Adverts
            </div>
            <div class="panel-body">
              Some adverts here.
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              Adverts
            </div>
            <div class="panel-body">
              Some adverts here.
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              Adverts
            </div>
            <div class="panel-body">
              Some adverts here.
            </div>
          </div>
        </div>
      </div>
@endsection
