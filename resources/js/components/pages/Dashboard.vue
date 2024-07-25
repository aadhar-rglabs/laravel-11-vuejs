<template>
    <div class="wrapper">

        <!-- <Preloader /> -->

        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <Box stats="150" title="New Orders" class="small-box bg-info" link="link"></Box>
                        </div>
                        <div class="col-lg-3 col-6">
                            <Box stats="53" title="Bounce Rate" class="small-box bg-success" link="link"></Box>
                        </div>
                        <div class="col-lg-3 col-6">
                            <Box stats="44" title="User Registrations" class="small-box bg-warning" link="link"></Box>
                        </div>
                        <div class="col-lg-3 col-6">
                            <Box stats="65" title="Unique Visitors" class="small-box bg-danger" link="link"></Box>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <Sales title="Sales" />
                            <!-- /.card -->

                            <!-- TO DO List -->
                            <ToDoList title="TO DO List" />
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->

                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">
                            <!-- Map card -->
                            <Map title="Visitors" />
                            <!-- /.card -->

                            <!-- solid sales graph -->
                            <SalesGraph title="Sales Graph" />
                            <!-- /.card -->

                            <!-- Calendar -->
                            <Calendar title="Calendar" />
                            <!-- /.card -->
                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        <Footer />

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</template>


<script>
import Preloader from '../../components/partials/Preloader.vue'
import Box from '../../components/partials/Box.vue'
import Sales from '../../components/partials/Sales.vue'
import ToDoList from '../../components/partials/ToDoList.vue'
import Map from '../../components/partials/Map.vue'
import SalesGraph from '../../components/partials/SalesGraph.vue'
import Calendar from '../../components/partials/Calendar.vue'
import Footer from '../../components/partials/Footer.vue'

export default {
 name: 'Dashboard',
 components: {
    Box,
    Sales,
    ToDoList,
    Map,
    SalesGraph,
    Calendar,
    Footer,
    Preloader,
 }
}
</script>

<style>
body {
 margin: 0;
 font-family: Arial, Helvetica, sans-serif;
}
</style>