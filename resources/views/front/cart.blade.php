@extends('layouts.index')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-8">
      <div class="card">
          <div class="card-body">
              <h5>Keranjang</h5>
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Email</th>
                  </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>John</td>
                          <td>Doe</td>
                          <td>john@example.com</td>
                      </tr>
                      <tr>
                          <td>Mary</td>
                          <td>Moe</td>
                          <td>mary@example.com</td>
                      </tr>
                    <tr>
                      <td>July</td>
                      <td>Dooley</td>
                      <td>july@example.com</td>
                  </tr>
              </tbody>
                </table>
              </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5>Checkout</h5>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection