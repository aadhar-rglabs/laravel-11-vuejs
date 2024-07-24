<template>
    <!-- small box -->
    <div class="">
        <div class="inner">
            <h3>{{ stats }}</h3>

            <p>{{ title }}</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{link}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</template>


<script>
export default {
    name: 'Box',
    props: [
        'title',
        'stats',
        'link',
    ]
}
</script>