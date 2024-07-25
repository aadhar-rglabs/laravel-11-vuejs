<template>
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('public/assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
            height="60" width="60">
    </div>
</template>

<script>
export default {
    name: 'Preloader',
    props: [
        'title',
    ]
}
</script>