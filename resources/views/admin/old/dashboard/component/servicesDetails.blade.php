

<!--
there is basic html change what you want but
    1- leave tag that value will be insert into must be with id "s-***" and class "loaderGif"
-->

<div id="pub-stat" class="col-md-3 col-sm-3">
    <div class="white-panel boxShadow mb panel-height">
        <div class="panel-header">
            <h3 class="custome-title">{{__('admin.Services details')}}</h3>
        </div>
        <p>Total of <span id="totalServices"></span></p>
        <div class="col-md-4 col-sm-4">
            <div class="">
                <a href="admin/services/index?status=1">
                    <div class="centered">
                        <h1 class="mt green-text loaderGif" id="s-approved"></h1>
                    </div>
                </a>
                <footer>
                    <h5>{{__('admin.approved')}}</h5>
                </footer>
                <!--        <p></p>-->
                <br/>
            </div>
            <!-- -- /darkblue panel ---->
        </div>
        <div class="col-md-4 col-sm-4" style="border-right: 2px solid #f5f5f5;border-left: 2px solid #f5f5f5;">
            <div class="">

                <a href="admin/services/index?status=2">
                    <div class="centered">
                        <h1 class="mt orange-text loaderGif" id="s-panding"></h1>
                    </div>
                </a>
                <footer>
                    <h5>{{__('admin.panding')}}</h5>
                </footer>
                <!--        <p></p>-->
                <br/>
            </div>
            <!-- -- /darkblue panel ---->
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="">

                <a href="admin/services/index?status=0">
                    <div class="centered">
                        <h1 class="mt red-text loaderGif" id="s-reject"></h1>
                    </div>
                </a>
                <footer>
                    <h5>{{__('admin.rejected')}}</h5>
                </footer>
                <!--        <p></p>-->
                <br/>
            </div>
            <!-- -- /darkblue panel ---->
        </div>

    </div>
</div>
