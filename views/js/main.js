document.addEventListener("DOMContentLoaded", () => {

    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        alert("Clic droit désactivé !");
    });

    document.addEventListener("keydown", function(e) {
        if (e.ctrlKey && e.key === "c"  ) {
            e.preventDefault();
        }
        else if(e.ctrlKey && e.key === "a")
        {
            e.preventDefault();
        }
        else if(e.ctrlKey && e.key === "f")
        {
            e.preventDefault();
        }
        else if(e.ctrlKey && e.key === "p")
        {
            e.preventDefault();
        }
        else if(e.ctrlKey && e.key === "q")
        {
            e.preventDefault();
        }
        else if(e.altKey && e.key === "e")
        {
            e.preventDefault();
        }
        else if(e.altKey && e.key === "f")
        {
            e.preventDefault();
        }

        //CTRL + SHIFT
        if(e.ctrlKey && e.shiftKey && e.key === "i")
        {
            e.preventDefault();
        }
        if(e.ctrlKey && e.shiftKey && e.key === "j")
        {
            e.preventDefault();
        }
        if(e.ctrlKey && e.shiftKey && e.key === "q")
        {
            e.preventDefault();
        }
    });

    document.addEventListener("touch",function(e){
        e.preventDefault();
    });
})