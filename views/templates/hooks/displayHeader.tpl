<script>
document.addEventListener("DOMContentLoaded", () => {

    document.addEventListener('contextmenu', function(e) {
        if (window.screen.width < 767){
            if ({$switch_block_click_device} == 1) {
                e.preventDefault();
                alert('Disable touch !');
            }
        }
        else
        {
            if ({$switch_click_right} == 1) {
                e.preventDefault();
                alert("Clic droit désactivé !");
            }            
        }
    });

    document.addEventListener("keydown", function(e) {
        const preventDefault = (condition, message) => {
            if (condition) {
                e.preventDefault();
                alert(message);
            }
        };

        // CTRL
        preventDefault(e.ctrlKey && e.key === "c" && {$switch_block_copy} == 1, "Copy disable !");
        preventDefault(e.ctrlKey && e.key === "a" && {$switch_block_select} == 1, "Select disable !");
        preventDefault(e.ctrlKey && e.key === "f" && {$switch_block_search} == 1, "Search disable !");
        preventDefault(e.ctrlKey && e.key === "p" && {$switch_ctrl_p} == 1, "Disable ctrl+p !");
        preventDefault(e.ctrlKey && e.key === "q" && {$switch_ctrl_q} == 1, "Disable ctrl+q !");

        // ALT
        preventDefault(e.altKey && e.key === "e" && {$switch_alt_e} == 1, "Disable alt+e !");
        preventDefault(e.altKey && e.key === "f" && {$switch_alt_f} == 1, "Disable alt+f !");

        // CTRL + SHIFT
        preventDefault(e.ctrlKey && e.shiftKey && e.key === "i" && {$switch_shift_i} == 1, "Disable ctrl+shift+i !");
        preventDefault(e.ctrlKey && e.shiftKey && e.key === "j" && {$switch_shift_j} == 1, "Disable ctrl+shift+j !");
        preventDefault(e.ctrlKey && e.shiftKey && e.key === "q" && {$switch_shift_q} == 1, "Disable ctrl+shift+q !");
    });

});
</script>