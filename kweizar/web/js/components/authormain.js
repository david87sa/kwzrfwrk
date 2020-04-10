/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function($){
    AUTHOR={
        
        INIT:function(){
            addComponent = $("#add").clone();
            $(addComponent).addClass("addSection");
            $("#toolbarContent").append(addComponent);
            
            $(".container").each(function(){
                editComponent = $("#addeditdelete").clone();
                $(editComponent).find("#addChild").addClass("addElement");
                $(editComponent).find("#edit").addClass("editElement");
                $(editComponent).find("#delete").addClass("deleteElement");
                $(this).append(editComponent);
            });
            $(".element").each(function(){
                editComponent = $("#editdelete").clone();
                $(editComponent).find("#edit").addClass("editElement");
                $(editComponent).find("#delete").addClass("deleteElement");
                $(this).append(editComponent);
            });
            $(".element").off("click");
            $(document).on("click",".addSection",function(){
                $.magnificPopup.open({
                    
                    items: {
                        src: '#section_form',
                        type: 'inline'
                    }
                });
            });
            $(document).on("click",".addElement",function(){
                $.magnificPopup.open({
                    
                    items: {
                        src: '#element_form',
                        type: 'inline'
                    }
                });
                window.currentSectionId=$(this).parent().parent().attr("sectionid");
                window.currentElementId=$(this).parent().parent().attr("elementid");
            });
            $(document).on("click",".deleteElement",function(evt){
                evt.preventDefault();
                response = confirm("De verdad lo quiere borrar?");
                if (response){
                    
                    window.currentSectionId=$(this).parent().parent().parent().parent().parent().parent().attr("sectionid");
                    window.currentElementId=$(this).parent().parent().attr("elementid");
                    
                    $.ajax("/app_dev.php/author/MainComponent/deleteElement/"+window.currentElementId ,
                        { 
                            type:"POST",
                            data:$(this).serialize()
                        }).done(function(data){
                            $("#section"+window.currentSectionId+" .sectionHeder").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionHeader"));
                            $("#section"+window.currentSectionId+" .sectionContent").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionContent"));
                            
                            $("#section"+window.currentSectionId+" .element").css("opacity","1");
                            $("#section"+window.currentSectionId+" .element").css("margin","0 20px");
                            window.currentSectionId=null;
                            window.currentElementId=null;
                            $.magnificPopup.instance.close();
                            AUTHOR.INIT();
                        }); 
                }
            });
            $(document).on("click",".deleteSectionType",function(evt){
                evt.preventDefault();
                response = confirm("De verdad lo quiere borrar?");
                if (response){
                                        
                    $.ajax("/app_dev.php/author/MainComponent/sectiontype/delete/"+$(this).attr("sectiontypeid"),
                        { 
                            type:"POST",
                            data:$(this).serialize()
                        }).done(function(data){
                            $("#section"+window.currentSectionId+" .sectionHeder").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionHeader"));
                            $("#section"+window.currentSectionId+" .sectionContent").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionContent"));
                            
                            $("#section"+window.currentSectionId+" .element").css("opacity","1");
                            $("#section"+window.currentSectionId+" .element").css("margin","0 20px");
                            window.currentSectionId=null;
                            window.currentElementId=null;
                            location.reload();
                        }); 
                }
            });
            
            $(document).on("click",".editElement",function(){
                workingElement = $(this).parent().parent();
                $("#element_form").find("#form_imgSrc").val($(workingElement).find(".image img").attr("src"));
                $("#element_form").find("#form_title").val($(workingElement).find(".content .title").html());
                $("#element_form").find("#form_description").val($(workingElement).find(".content .description").html());
                $("#element_form").find("#form_destinationType").val($(workingElement).find(".content .link").attr("destinationType")); 
                $("#element_form").find("#form_destinationContent").val($(workingElement).find(".content .link div").html());
                $.magnificPopup.open({
                    
                    items: {
                        src: '#element_form',
                        type: 'inline'
                    }
                });
                window.currentElementId=$(this).parent().parent().attr("elementid");
            });
            $(".section_form").on("submit","#add_section",function(evt){
                evt.preventDefault();
                $.ajax($(this).attr("action")+"?parentid="+$("#container").attr("containerid"),
                    { 
                        type:"POST",
                        data:$(this).serialize()
                    }).done(function(data){
                            $("#section"+window.currentSectionId+" .sectionHeder").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionHeader"));
                            $("#section"+window.currentSectionId+" .sectionContent").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionContent"));
                            
                            window.currentSectionId=null;
                            window.currentElementId=null;
                            AUTHOR.INIT();
                        }); 
            });   
            $(".element_form").on("submit","#add_element",function(evt){
                evt.preventDefault();
                if (window.currentSectionId){
                    $.ajax($(this).attr("action")+"?sectionid="+window.currentSectionId ,
                        { 
                            type:"POST",
                            data:$(this).serialize()
                        }).done(function(data){
                            $("#section"+window.currentSectionId+" .sectionHeder").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionHeader"));
                            $("#section"+window.currentSectionId+" .sectionContent").replaceWith($(data).find("#section"+window.currentSectionId+" .sectionContent"));
                            
                            $("#section"+window.currentSectionId+" .element").css("opacity","1");
                            $("#section"+window.currentSectionId+" .element").css("margin","0 20px");
                            
                            window.currentSectionId=null;
                            window.currentElementId=null;
                            $.magnificPopup.instance.close();
                            AUTHOR.INIT();
                        }); 
                }
                if (window.currentElementId){
                    $.ajax("/app_dev.php/author/MainComponent/element/edit?elementid="+window.currentElementId ,
                        { 
                            type:"POST",
                            data:$(this).serialize()
                        }).done(function(data){
                            $("#element-"+window.currentElementId+" .image").replaceWith($(data).find("#element-"+window.currentElementId+" .image"));
                            $("#element-"+window.currentElementId+" .content").replaceWith($(data).find("#element-"+window.currentElementId+" .content"));
                            window.currentSectionId=null;
                            window.currentElementId=null;
                            $.magnificPopup.instance.close();
                        }); 
                }
            });   
        }
    };
    
    
})(mjq);


