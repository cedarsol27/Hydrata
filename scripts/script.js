    // add new crop
    function addNew() {
        window.name = "Add new bath";
        var newCrop = window.prompt("Enter the name of bath:");
        if ( newCrop == null ) { return; }
        else { window.location.href = "add-data.php?crop=" + newCrop; }
    };

    function addSeed() {
        window.name = "Add new seed";
        var newSeed = window.prompt("Enter the name of the seed:");
        if ( newSeed == null ) { return; }
        else { window.location.href = "add-data.php?seed=" + newSeed; }
    };

    // build calendar event
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    };
    
    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    };

    // show/hide previous data
    $(document).ready(function(){
        $("#showData").on('click', function(){
            $("#dataForm").fadeToggle();
        })
    });
