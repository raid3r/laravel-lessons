<?php
/**
 * @var int $value
 */

?>
<div class="progress" style="width: 100%; height: 2rem; border: solid 1px gray">
    <div class="progress-bar" role="progressbar" style="width: {{$value}}%;" aria-valuenow="{{$value}}"
         aria-valuemin="0" aria-valuemax="100">{{$value}}%
    </div>
</div>
