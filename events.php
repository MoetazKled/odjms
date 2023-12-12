<div class="content py-5">
    <h3 class="text-center"><b>We do Services for the following Events</b></h3>
    <hr class="w-25 border-light">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="input-group mb-2">
                <input type="search" id="search" class="form-control form-control-border" placeholder="Search event here...">
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm border-0 border-bottom btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" id="event-list">
        <?php  
        $events = $conn->query("SELECT * FROM `event_list` where delete_flag = 0 and status = 1 order by `name` asc");
        while($row = $events->fetch_assoc()):
        ?>
        <div class="col-sm-12 col-md-6 col-lg-4 event-item">
            <a class="text-docoration-none text-reset view_event" data-id="<?= $row['id'] ?>" href="javascript:void(0)">
                <div class="callout border-primary rounded-0 shadow">
                    <h4><b><?= $row['name'] ?></b></h4>
                    <p class="truncate-3"><?= $row['description'] ?></p>
                </div>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
    <?php if($events->num_rows < 1): ?>
        <center><span class="text-muted">No event Listed Yet.</span></center>
    <?php endif; ?>
        <div id="no_result" style="display:none"><center><span class="text-muted">No event Listed Yet.</span></center></div>
</div>
<script>
    $(function(){
        $('.view_event').click(function(){
            uni_modal("Event Type Details","view_event.php?id="+$(this).attr('data-id'))
        })
        $('#search').on("input",function(e){
            var _search = $(this).val().toLowerCase()
            $('#event-list .event-item').each(function(){
                var _txt = $(this).text().toLowerCase()
                if(_txt.includes(_search) === true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
                if($('#event-list .event-item:visible').length <= 0){
                    $("#no_result").show('slow')
                }else{
                    $("#no_result").hide('slow')
                }
            })
        })
    })
</script>