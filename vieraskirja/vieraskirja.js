function rating(p){
    var paarynat = p;

    if(paarynat == 1){
       document.getElementById("arvio").value = "1";
            $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
            $("#p2, #p3, #p4, #p5").css("opacity", "0.2");
    }
    else if(paarynat == 2){
        document.getElementById("arvio").value = "2";
                $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
               $("#p3, #p4, #p5").css("opacity", "0.2");
    
        
    }
    else if(paarynat == 3){
        document.getElementById("arvio").value = "3";
                $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
                $("#p4, #p5").css("opacity", "0.2");

    }
    else if(paarynat == 4){
        document.getElementById("arvio").value = "4";
                $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
                $("#p5").css("opacity", "0.2");
    }
    else {
        document.getElementById("arvio").value = "5";
        $("#p1, #p2, #p3, #p4, #p5").css("opacity", "1");
    }
}