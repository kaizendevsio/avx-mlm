<?php
foreach (glob("views/*.php") as $filename)
{
    include $filename;
}
?>

<script>


const root = document.documentElement;
 
document.addEventListener('mousemove', evt => {
let x = evt.clientX / innerWidth;
let y = evt.clientY / innerHeight;
 
root.style.setProperty('--mouse-x', x);
root.style.setProperty('--mouse-y', y);
});

</script>