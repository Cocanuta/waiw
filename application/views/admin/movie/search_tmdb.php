<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-10 col-lg-offset-1">
    <h2>Search Movie</h2>
    <div class="input-group input-group-lg">
        <input class="form-control" type="text" id="search">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="searchbutton">Search</button>
        </span>
    </div>
    <ul class="list-group" id="results">
    </ul>
</div>

<script type="application/javascript">
    $('#searchbutton').click(function () {
        var output = '<div class="list-group">'
        $.ajax({
            type:'POST',
            url:'<?= site_url() . 'admin/movie/do_search' ?>',
            data:{'search' : $('#search').val()},
            success: function(data) {
                var json = $.parseJSON(data);
                $.each(json, function(index, value) {
                    output += '<a href="<?= site_url() . 'admin/movie/add/' ?>' + value.id + '" class="list-group-item">' + value.title + '</a>';
                })
                output += '</div>';
                $('#results').html(output);
            }
        })
    })
</script>