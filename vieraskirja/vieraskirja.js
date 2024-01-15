function rating(p){
    var paarynat = p;

    if(paarynat == 1){
       document.getElementById("arvio").value = "1";
        $(document).ready(function(){
        $("#p1").click(function(){
            $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
            $("#p2, #p3, #p4, #p5").css("opacity", "0.2");
            });
        });
    }
    else if(paarynat == 2){
        document.getElementById("arvio").value = "2";
        $(document).ready(function(){
            $("#p2").click(function(){
                $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
                $("#p3, #p4, #p5").css("opacity", "0.2");
                });
            });
        
    }
    else if(paarynat == 3){
        document.getElementById("arvio").value = "3";
        $(document).ready(function(){
            $("#p3").click(function(){
                $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
                $("#p4, #p5").css("opacity", "0.2");
                });
            });
    }
    else if(paarynat == 4){
        document.getElementById("arvio").value = "4";
        $(document).ready(function(){
            $("#p4").click(function(){
                $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
                $("#p5").css("opacity", "0.2");
                });
            });
    }
    else {
        document.getElementById("arvio").value = "5";
        $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
    }
}