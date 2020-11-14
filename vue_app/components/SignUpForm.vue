<template>
  <div class="container">
    <h1>Sign Up Form</h1>

    <div class="alert alert-success" role="alert" v-if="formSubmittedSuccess">
      Congratulations! You account registered successfully
    </div>

    <form method="post" v-on:submit.prevent="submitForm" v-else>
      <div class="form-group">
        <label for="fullname">Fullname</label>
        <input type="text" class="form-control" id="fullname" v-model="fullname" placeholder="Enter your name">
        <small class="form-text text-danger" v-if="validationErrors.fullname">
          {{ validationErrors.fullname }}
        </small>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" v-model="username" aria-describedby="emailHelp" placeholder="Enter username">
        <small class="form-text text-danger" v-if="validationErrors.username">
          {{ validationErrors.username }}
        </small>
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" v-model="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small class="form-text text-danger" v-if="validationErrors.email">
          {{ validationErrors.email }}
        </small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" v-model="password" placeholder="Password">
        <small class="form-text text-danger" v-if="validationErrors.password">
          {{ validationErrors.password }}
        </small>
      </div>
      <button type="submit" class="btn btn-success">Register</button>
    </form>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'SignUpForm',
        data () {
            return {
                msg: 'SignUpForm',

                fullname: '',
                username: '',
                email: '',
                password: '',

                validationErrors: {},
                formSubmittedSuccess: false
            }
        },
        methods: {
            submitForm: function (event) {
                event.preventDefault();

                let component = this;
                let body = {
                    fullname: this.fullname,
                    username: this.username,
                    email: this.email,
                    password: this.password,
                };

                axios.create().post('/sign-up-handler', body).then(function (response) {
                    if(response.data.status === 400){
                      component.validationErrors = response.data.errors;
                    }
                    else{
                      component.formSubmittedSuccess = true;
                      component.validationErrors = {};
                    }
                }).catch(function (error) {
                    let message = 'Internal server error';
                    alert(message);
                    console.log(message);
                    console.log(error.response);
                });
            }
        }
    }
</script>

<style>
  .container {
    padding-top: 50px;
  }
</style>