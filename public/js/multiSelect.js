//Select multiple without holding ctrl for multi-select lists
$("select[multiple] option").mousedown(function(){
    var $self = $(this);
    if ($self.prop("selected"))
        $self.prop("selected", false);
    else
        $self.prop("selected", true);
    return false;
});