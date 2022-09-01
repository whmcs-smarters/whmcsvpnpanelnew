<div class="row home-status-badge-row" style="margin-top: 20px;padding: 10px;">
    <div class="col-sm-3">
        <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=list&amp;common=all">
            <div class="health-status-block status-badge-green clearfix">
                <div class="detail">
                        <span class="count">{if isset($GetTotalCodes)} {$GetTotalCodes} {/if} </span>
                        <span class="desc">Total Codes</span>
                </div>
            </div>
        </a>

    </div>
    <div class="col-sm-3">
        <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=list&amp;common=allactive">
            <div class="health-status-block status-badge-pink clearfix">
                <div class="detail">
                        <span class="count">{if isset($GetActiveTotalCodes)} {$GetActiveTotalCodes} {/if}</span>
                        <span class="desc">Total Active Codes</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=list&amp;common=allinactive">
            <div class="health-status-block status-badge-orange clearfix">
                <div class="detail">
                        <span class="count">{if isset($GetInActiveTotalCodes)} {$GetInActiveTotalCodes} {/if}</span>
                        <span class="desc">Total Inactive Codes</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=list&amp;common=allactivecurrentmonth">
            <div class="health-status-block status-badge-cyan clearfix">
                <div class="detail">
                    
                        <span class="count">{if isset($GetActiveTotalCodesCurrentMonth)} {$GetActiveTotalCodesCurrentMonth} {/if}</span>
                        <span class="desc" style=" width: 122%;">Total active in current month ({if isset($currentdate)} {$currentdate} {/if})</span>
                    
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row home-status-badge-row" style="margin-top: 20px;padding: 10px;">
    <h4 style="    font-size: 20px;    font-weight: bold;">Quick Links</h4>
    <ul class="list-links">
        <li><a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=generate">Generate Codes</a></li>
        <li><a href="index.php?m=xtreamdashboard&amp;action=actvationcodes&amp;subpage=list&amp;common=all">List Generated Codes</a></li>
    </ul>
</div>