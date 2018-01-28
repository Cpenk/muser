


<div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>1</h3>
                  <p>Administrator</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>2</h3>
                  <p>User</p>
                </div>
                <div class="icon">
                  <i class="fa fa-stethoscope"></i>
                </div>
                <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>





    <div class="col-md-4">




        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

    <script type="text/javascript">
      jQuery(document).ready(function(){
        jQuery("#mapsvg_1").mapSvg({
                            width: 792.54596,
                            height: 316.66394,
                            viewBox: [0,0,792,316],
                            gauge: {
                              on: false,
                              labels: {
                                low: "low",
                                high: "high"},
                                colors: {
                                  lowRGB: {r: 85,g: 0,b: 0,a: 1},
                                  highRGB: {r: 238,g: 0,b: 0,a: 1},
                                  low: "#550000",
                                  high: "#ee0000",
                                  diffRGB: {r: 153,g: 0,b: 0,a: 0}
                                },
                                min: 0,
                                max: false},
                                source: "<?=base_url('mapsvg/maps/geo-calibrated/indonesia.svg')?>",
                                title: "Indonesia",
                                responsive: true
                              });
      });
    </script>
