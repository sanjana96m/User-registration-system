<?php
    session_start();

    if (!isset($_SESSION['loggedIn'])){
      header('Location: login.php');
      exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cbe48029ea.js"></script>
    
    <style>
        #overlay{
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
        }
        #overlay .btn-width{
            width: 100%;
            margin-top: 20px;
        }
    </style>
  </head>
<body>
    <div id="app">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6">
                    <h3 class="text-info">Registered Users</h3>
                </div>

                <div class="col-lg-6">
                    <button class="btn btn-info float-end" @click="showAddModal=true">Add New User</button>
               </div>

            <!-- Alert box -->
            </div>
            <hr class="bg-info">
            <div class="alert alert-danger" v-if="errorMsg">
                {{ errorMsg }}
            </div>
            <div class="alert alert-success" v-if="successMsg">
              {{ successMsg }}
            </div>

            <!-- Table section  -->
            <div class="table-responsive-md">
                <table class="table table-bordered mt-4">
                    <thead class="bg-i">
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="user in users">
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.phone }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.password }}</td>
                        <td><a href="#" class="text-success" @click="showEditModal=true; selectUser(user);"><i class="fas fa-user-edit"></i></a></td>
                        <td><a href="#" class="text-danger" @click="showDelModal=true; selectUser(user);"><i class="fas fa-trash-alt"></i></a></td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <a href="logout.php"><button class="btn btn-secondary float-end ms-3">Logout</button></a>
        </div>

        <!-- Add new user -->
        <div id="overlay" v-if="showAddModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="showAddModal=false"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-2">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" v-model="newUser.name">
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Phone</label>
                              <input type="text" name="phone" class="form-control" v-model="newUser.phone">
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" v-model="newUser.email">
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Password</label>
                              <input type="password" name="password" class="form-control" v-model="newUser.password">
                            </div>
                            <button type="submit" class="btn btn-info btn-width" @click="showAddModal=false; addUser(); clearMsg();">Add User</button>
                          </form>
                    </div>
                </div>
             </div>
        </div>

        <!-- Delete user  -->
        <div id="overlay" v-if="showDelModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-dark">Delete User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="showDelModal=false"></button>
                </div>
                <div class="modal-body">
                    <h6>Are You Sure want to Delete this User?</h6>
                    <button class="btn btn-info" @click="showDelModal=false; deleteUser(); clearMsg();">Yes</button>
                    &nbsp;&nbsp;
                    <button class="btn btn-secondary" @click="showDelModal=false">No</button>
                </div>
              </div>
            </div>
        </div>

        <!--Edit user -->
        <div id="overlay" v-if="showEditModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-dark">Edit User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="showEditModal=false"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-2">
                          <label class="form-label">Name</label>
                          <input type="text" class="form-control" v-model="currentUser.name">
                        </div>
                        <div class="mb-2">
                          <label class="form-label">Phone</label>
                          <input type="text" class="form-control" v-model="currentUser.phone">
                        </div>
                        <div class="mb-2">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" v-model="currentUser.email">
                        </div>
                        <div class="mb-2">
                          <label class="form-label">Password</label>
                          <input type="password" class="form-control" v-model="currentUser.password">
                        </div>
                        <button type="submit" class="btn btn-info btn-width" @click="showEditModal=false; editUser(); clearMsg();">Edit User</button>
                      </form>
                </div>
            </div>
        </div>
        <!-- clossApp -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>


    <script type="text/javascript">
            var app = new Vue({
            el: '#app',
            data(){
              return{
                  errorMsg: "",
                  successMsg: "",
                  showAddModal: false,
                  showEditModal: false,
                  showDelModal: false,
                  action: "",
                  users: [],
                  newUser: {name: "",phone: "",email: "",password: ""},
                  currentUser: {}
              }
          },
          mounted: function(){
              this.getAllUsers();
          },
          methods:{
            // Select user details
              getAllUsers(){
                  axios.get("http://localhost/LoginSystem/config.php?action=read").then(function(response){
                      if(response.data.error){
                          app.errorMsg=response.data.message;
                      }
                      else{
                          app.users = response.data.users;
                      }
                  });
              },
            //   new user adding
              addUser(){
                  var formData=app.toFormData(app.newUser);
                  axios.post("http://localhost/LoginSystem/config.php?action=create", formData).then(function(response){
                      app.newUser = {name:"", phone:"", email:"", password:""};
                      if(response.data.error){
                          app.errorMsg=response.data.message;
                      }
                      else{
                          app.successMsg = response.data.message;
                          app.getAllUsers();
                      }
                  });
              },
              //    user details update
              editUser(){
                var formData=app.toFormData(app.currentUser);
                axios.post("http://localhost/LoginSystem/config.php?action=edit", formData).then(function(response){
                    app.currentUser = {};
                    if(response.data.error){
                        app.errorMsg=response.data.message;
                    }
                    else{
                        app.successMsg = response.data.message;
                        app.getAllUsers();
                    }
                });
            },
            //    user delete
            deleteUser(){
                var formData=app.toFormData(app.currentUser);
                axios.post("http://localhost/LoginSystem/config.php?action=delete", formData).then(function(response){
                    app.currentUser = {};
                    if(response.data.error){
                        app.errorMsg=response.data.message;
                    }
                    else{
                        app.successMsg = response.data.message;
                        app.getAllUsers();
                    }
                });
            },
              toFormData(obj){
                  var fd = new FormData();
                  for(var i in obj){
                      fd.append(i,obj[i]);
                  }
                  return fd;
              },
              selectUser(user){
                  app.currentUser=user;
              },
              clearMsg(){
                  app.errorMsg="";
                  app.successMsg="";
              }
          }
        })
  </script>
    
</body>
</html>