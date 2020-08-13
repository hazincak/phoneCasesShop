<template>
    <div>
        <div class="row">
            <div class="col-md-8" >
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="first_name">First name</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="first_name" 
                       >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Last name</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="last_name" 
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="email">Email</label>
                        <input 
                        type="email"
                         class="form-control"
                         name="email" 
                         >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="street">Street</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="street" 
                        >
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="city" 
                        >

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="county">County</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="county" 
                        >
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="state">State</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="state" 
                        >
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zip">Zip</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="zip" 
                        >
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button 
                        type="submit" 
                        class="btn btn-lg btn-primary btn-block" 
                        >Book now!</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8" >
                <div class="jumbotron jumbotron-fluid text-center">
                    <h1>Empty</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase text-secondary font-weight-bolder">Your Cart</h6>
                    <h6 class="badge badge-secondary text-uppercase">
                    </h6>
                </div>
            
                    <div>
                        <div class="pt-2 pb-2 border-top d-flex justify-content-between">
                            <span>
                                
                            </span>
                            <span class="font-weight-bold"></span>
                        </div>
                        <div class="pt-2 pb-2 d-flex justify-content-between">
                            <span></span>
                            <span></span>
                        </div>
                        <div class="pt-2 pb-2 text-right">
                            <button class="btn btn-sm btn-outline-secondary" 
                                      
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
            
            
            </div>
        </div>
    </div>
</template>