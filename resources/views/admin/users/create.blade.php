@extends('admin.app')
@section('content')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Create User</h4>
      <form class="form-sample">
        <p class="card-description">
          Personal info
        </p>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">First Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Last Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Email address</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Date of Birth</label>
              <div class="col-sm-9">
                <input class="form-control" placeholder="dd/mm/yyyy"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">phone number</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" />
              </div>
            </div>
          </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Country</label>
            <div class="col-sm-9">
              <select class="form-control">
                <option>America</option>
                <option>Italy</option>
                <option>Russia</option>
                <option>Britain</option>
              </select>
            </div>
          </div>
        </div>
        </div>
          <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">State</label>
              <div class="col-sm-9">
                <select class="form-control">
                  <option>America</option>
                  <option>Italy</option>
                  <option>Russia</option>
                  <option>Britain</option>
                </select>
              </div>
            </div>
            </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Address</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" />
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Instagram Url</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Start Date</label>
              <div class="col-sm-9">
                <input class="form-control" placeholder="dd/mm/yyyy"/>
              </div>
            </div>
          </div>

        </div>
        <div class="row">

          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">User Status</label>
              <div class="col-sm-9">
                <select class="form-control">
                  <option>subscriber</option>
                  <option>suspended</option>
                  <option>Finished</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Join the mailing list</label>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked>
                    yes
                  </label>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2">
                    no
                  </label>
                </div>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
