<div class="flow-drop" ondragenter="jQuery(this).addClass('flow-dragover');" ondragend="jQuery(this).removeClass('flow-dragover');" ondrop="jQuery(this).removeClass('flow-dragover');">
    Drop files here to upload or
    <a class="flow-browse-folder flow">
        <u>select folder</u>
    </a> or
    <a class="flow-browse flow">
        <u>select from your computer</u>
    </a> or
    <a class="flow-browse-image flow">
        <u>select images</u>
    </a>

</div>

<div class="flow-progress">
    <table>
        <tr>
            <td width="100%"><div class="progress-container"><div class="progress-bar"></div></div></td>
            <td class="progress-text" nowrap="nowrap"></td>
            <td class="progress-pause" nowrap="nowrap">
                <a href="#" onclick="r.upload(); return(false);" class="progress-resume-link"><img src="/assets/img/resume.png" title="Resume upload" /></a>
                <a href="#" onclick="r.pause(); return(false);" class="progress-pause-link"><img src="/assets/img/pause.png" title="Pause upload" /></a>
                <a href="#" onclick="r.cancel(); return(false);" class="progress-cancel-link"><img src="/assets/img/cancel.png" title="Cancel upload" /></a>
            </td>
        </tr>
    </table>
</div>

<ul class="flow-list"></ul>