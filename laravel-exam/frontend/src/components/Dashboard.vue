<!-- frontend/src/components/Dashboard.vue -->
<template>
    <div class="dashboard">
      <h1>Dashboard</h1>
      <p>Welcome to your dashboard!</p>
    </div>
  </template>
  
  <script>
  export default {
    name: "Dashboard",
    async created() {
    try {
      // Make a request to the backend to check if the user is authenticated
      const response = await axios.get('http://localhost:8000/api/user');  // You need to set up this route in Laravel

      if (!response.data.authenticated) {
        // If the user is not authenticated, redirect them to the login page
        this.$router.push('/');
      }
    } catch (error) {
      // In case of any error (e.g., unauthorized), redirect to login
      this.$router.push('/');
    }
  }
};
  </script>
  
  <style scoped>
  /* Add some basic styling */
  .dashboard {
    padding: 20px;
  }
  </style>
  