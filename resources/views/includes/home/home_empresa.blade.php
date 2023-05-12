 <!-- Info boxes -->
 <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Productos</span>
                <span class="info-box-number">{{ count($productos) }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Ordenes</span>
                <span class="info-box-number">{{count($ordens)}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Entregas</span>
                <span class="info-box-number">{{count($entregas)}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
       <div class="card">
           <div class="card-body text-center">
               <div id="contenedorFecha" style="flex-direction: column;">
                   <span id="txtFecha"></span>
                   <span id="txtHora"></span>
               </div>
           </div>
       </div>
   </div>
    <!-- /.col -->
</div>
