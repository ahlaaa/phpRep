<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="position: absolute;top:50px;bottom: 0;right: 0;left: 0;">

        <!-- Sidebar user panel (optional) -->
        

        <!-- search form (Optional) -->
        
            
                
          
            
            
          
            
        
        <!-- Sidebar Menu -->

        <ul class="sidebar-menu" style="height: 100%;">
            <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>