<table class="tree" data-controller="{$controller}" data-model="{$model}">

    {foreach item=item key=key from=$data}
        <tr class="treegrid-{$item->getId()}  {$item->getType()}" data-id ="{$item->getId()}" >
            <td><img src="{$item->getTypeImage()}"/> {$item->getName()}</td><td> <span class="fa fa-plus addItem"></span></td>
        </tr>

        {include file="templates/controls/treegrid/treegriditem.tpl" item=$item  }

    {/foreach}

</table>

<script src="{$BASEPATH}public/js/jquery.min.js"></script>

<script type="text/javascript">
    {literal}
        $(document).ready(function () {


            $(".draggable").draggable(
                    {
                        helper: function () {
                            return "<div class='ghost'></div>";
                        },
                        start: resizeGhost,
                        revert: 'invalid',
                        handle: '.moveItem',
                        snap: true
                    });

            function resizeGhost(event, ui) {
                var helper = ui.helper;
                var element = $(event.target);
                helper.width(element.width());
                helper.height(element.height());
            }

            $(".droppable").droppable({
                hoverClass: 'ui-state-active',
                drop: function (event, ui) {
                    var target = $(event.target);
                    var draggable = ui.draggable;


                    draggable.insertAfter(target);
                }
            });





            basepath = $("#basepath").val();
               $('.tree').treegrid();
            $(".addItem").click(function ()
            {
                var controller = $(".tree").attr("data-controller");
                var model = $(".tree").attr("data-model");
                var pid = $(this).parent().parent().attr("data-id");
                $.ajax({
                    method: "POST",
                    url: basepath + "" + controller + "/editform/pid/" + pid,
                    data: {"model": model},
                    success: function (result) {
                        swal({
                            title: "Neu",
                            text: result,
                            html: true,
                            showCancelButton: true,
                            cancelButtonText: "Abbrechen",
                            closeOnConfirm: false,
                            confirmButtonText: "Abschicken"
                        }, function () {


                            var form = new FormData($('#editform')[0]);
                            $.ajax({
                                method: "POST",
                                url: basepath + "" + controller + "/upsert",
                                data: form,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (result) {
                                    //    location.reload();
                                },
                                complete: function () {
                                }
                            })


                        });

                        $(".typeChoose").change(function ()
                        {
                            $(".formContent").hide();
                            $(".form-" + $(this).val()).show();
                            $(".type").val($(this).val());

                            $(".parentId").val(pid);
                        });
                    },
                    complete: function () {
                        $('input.input-item').show();
                    }
                })

            });

            $(".editItem").click(function ()
            {
                var controller = $(".tree").attr("data-controller");
                var model = $(".tree").attr("data-model");
                var pid = $(this).parent().parent().attr("data-id");
                $.ajax({
                    method: "POST",
                    url: basepath + "" + controller + "/editform/id/" + pid,
                    data: {"model": model},
                    success: function (result) {
                        swal({
                            title: "Editieren",
                            text: result,
                            html: true,
                            showCancelButton: true,
                            cancelButtonText: "Abbrechen",
                            closeOnConfirm: false,
                            confirmButtonText: "Abschicken"
                        }, function () {
                            $.ajax({
                                method: "POST",
                                url: basepath + "" + controller + "/upsert",
                                data: $("#editform").serialize(),
                                success: function (result) {
                                    location.reload();
                                },
                                complete: function () {
                                }
                            })
                        });
                    },
                    complete: function () {
                        $('input.input-item').show();
                    }
                })

            });

            $(".addContent").click(function ()
            {
                var controller = "content";
                var model = $(".tree").attr("data-model");
                var pid = $(this).parent().parent().attr("data-id");
                $.ajax({
                    method: "POST",
                    url: basepath + "" + controller + "/editform/cid/" + pid,
                    data: {"model": model},
                    success: function (result) {
                        swal({
                            title: "Inhalt hinzüfügen",
                            text: result,
                            html: true,
                            showCancelButton: true,
                            cancelButtonText: "Abbrechen",
                            closeOnConfirm: false,
                            confirmButtonText: "Abschicken"
                        }, function () {
                            $.ajax({
                                method: "POST",
                                url: basepath + "" + controller + "/upsert",
                                data: $("#editform").serialize(),
                                success: function (result) {
                                    location.reload();
                                },
                                complete: function () {
                                }
                            })
                        });
                    },
                    complete: function () {
                        $('input.input-item').show();
                    }
                })

            });

            $(".deleteItem").click(function ()
            {
                var controller = $(".tree").attr("data-controller");
                var model = $(".tree").attr("data-model");
                var pid = $(this).parent().parent().attr("data-id");
                $.confirm({
                    text: "Wirklich löschen?",
                    confirmButton: "Ja",
                    cancelButton: "Nein",
                    confirm: function () {

                        $.ajax({
                            method: "POST",
                            url: basepath + "" + controller + "/delete/id/" + pid,
                            data: {"model": model},
                            success: function (result) {
                                location.reload();
                            },
                            complete: function () {
                            }
                        })
                    },
                    cancel: function () {
                        // nothing to do
                    }
                });

            });
        });
    {/literal}
</script>