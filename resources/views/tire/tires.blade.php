@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Däck</div>
                    <div class="panel-body">
                        <div>

                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#file" aria-controls="file" role="tab" data-toggle="tab">Ta emot</a></li>
                            <li role="presentation"><a href="#return" aria-controls="return" role="tab" data-toggle="tab">Lämna tillbaka</a></li>
                          </ul>

                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="file">
                                <div class="well well-lg">
                                    <form action="/tire/file" method="post" novalidate>
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label><i class="fa fa-user"></i> Kund</label>
                                            <input type="number" class="form-control" placeholder="Kundnummer" name="customer_id">
                                            <input type="text" class="form-control" placeholder="Namn" name="name">
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label>Däcktyp</label>
                                            <select class="form-control" name="type">
                                                <option value="vinter">Vinter</option> 
                                                <option value="sommar">Sommar</option> 
                                                <option value="allround">Allround</option> 
                                            </select>
                                        </div>
                                        <div class="input-group">
                                          <span class="input-group-addon">Antal</span>
                                            <input type="number" name="number_of_tires" class="form-control" aria-label="Antal i styck">
                                            <span class="input-group-addon">styck</span> 
                                        </div>
                                        <div class="input-group">
                                          <span class="input-group-addon">Mönsterdjup</span>
                                          <input type="text" name="quality" class="form-control" aria-label="Mönsterdjup i mm">
                                          <span class="input-group-addon">mm</span>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label>Plats</label>
                                            <input class="form-control" name="position" type="text"></input>
                                        </div>
                                        <input type="submit" class="btn btn-success" value="Lämna in">
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="return">...</div>
                          </div>

                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
@endsection
