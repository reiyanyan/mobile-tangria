<script>
    localStorage.setItem('guest', true);
    localStorage.setItem('user_id', {{ $data->user_id }});

    window.location.pathname = "home";
</script>