<!-- frontend/src/components/Login.vue -->
<template>
    <div class="login-container">
      <h2>Login</h2>
      <form @submit.prevent="submitLogin">
        <div class="form-group">
          <label for="login">Username or Email:</label>
          <input
            type="text"
            v-model="login"
            id="login"
            placeholder="Enter your username or email"
            required
          />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input
            type="password"
            v-model="password"
            id="password"
            placeholder="Enter your password"
            required
          />
        </div>
        <div class="form-group">
          <input
            type="checkbox"
            v-model="remember"
            id="remember"
          />
          <label for="remember">Remember Me</label>
        </div>
        <button type="submit">Login</button>
        <p v-if="error">{{ error }}</p>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'LoginView',
    data() {
      return {
        login: '',
        password: '',
        remember: false,
        error: ''
      };
    },
    methods: {
      async submitLogin() {
        try {
          const response = await axios.post('http://localhost:8000/api/login', {
            login: this.login,
            password: this.password,
            remember: this.remember
          });
  
            // If login is successful, the backend returns a redirect URL (or similar success response)
            if (response.data.redirect_url) {
             // Redirect to the dashboard using Vue Router
            this.$router.push('/dashboard');
          }
        } catch (error) {
          this.error = "Login failed. Please check your credentials.";
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add some basic styling */
  .login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
  }
  </style>
  