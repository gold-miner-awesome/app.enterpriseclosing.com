<div class="assessments-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-bold mt-2 mr-4">Skills</h3>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-{{ 6 + count($dates) }} table-wrapper mt-2 mb-4 pr-4">
            <div class="assessments-table-wrapper" style="height: calc(100vh - 200px); overflow-y: auto;">
                <table class="table table-hover table-bordered w-100 mb-0" id="assessments-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="no-sort pl-2 pr-2" width="450"></th>
                            @foreach ($dates as $d)
                            <th scope="col" class="text-center no-sort pl-2 pr-2">{{ date('M \'d', strtotime($d)) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($assessments) && count($assessments) > 0)
                            <tr>
                                <td class="text-primary font-weight-bolder pl-2 pr-2">Total Performance</td>
                                @foreach ($dates as $d)
                                    @php
                                        $sum = 0;
                                        $cnt = 0;
                                    @endphp
                                    @foreach ($assessments as $a)
                                        @if (empty($a->parent_skill_id))
                                            @php
                                                $sum += $a->assessments[$d];
                                                $cnt++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $avg = ($cnt == 0) ? 0 : round($sum / $cnt);
                                    @endphp
                                    <td class="text-right text-dark bg-light align-middle"
                                        data-date="{{ $d }}">
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control text-right font-weight-bolder {{ getAssessmentClass($avg) }}"
                                                name="assessment_total_avgerage_{{ $d }}"
                                                placeholder="Assessment value..."
                                                aria-label="Assessment value..."
                                                aria-describedby="assessment_total_avgerage_{{ $d }}"
                                                value="{{ $avg }}"
                                                readonly/>
                                            <div class="input-group-append">
                                                <span class="input-group-text n-b-r" id="assessment_total_avgerage__{{ $d }}">%</span>
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                                </td>
                            </tr>

                            @foreach ($assessments as $a)
                            @if (empty($a->parent_skill_id))
                            <tr>
                                <td colspan="{{ count($dates) + 1 }}">&nbsp;</td>
                            </tr>
                                @php
                                    $skillTextColor = 'text-primary font-weight-bolder';
                                    $skillBgColor = '';
                                @endphp
                            @else
                                @php
                                    $skillTextColor = 'text-white';
                                    $skillBgColor = 'bg-black';
                                @endphp
                            @endif
                            <tr>
                                <td class="{{ $skillTextColor }} pl-2 pr-2">
                                    {{ $a->skill_name }}
                                </td>
                                @foreach ($dates as $d)
                                <td class="text-right text-dark bg-light align-middle"
                                    data-parent-skill-id="{{ $a->parent_skill_id }}"
                                    data-skill-id="{{ $a->skill_id }}"
                                    data-date="{{ $d }}">
                                    @if (!empty($a->parent_skill_id))
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control text-right data-cell {{ getAssessmentClass($a->assessments[$d]) }}"
                                                name="assessment_{{ $a->skill_id }}_{{ $d }}"
                                                placeholder="Assessment value..."
                                                aria-label="Assessment value..."
                                                aria-describedby="assessment_{{ $a->skill_id }}_{{ $d }}"
                                                value="{{ round($a->assessments[$d]) }}"
                                                min="0"
                                                max="100"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text n-b-r" id="assessment_{{ $a->skill_id }}_{{ $d }}">%</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control text-right data-cell-average font-weight-bolder {{ getAssessmentClass($a->assessments[$d]) }}"
                                                name="assessment_{{ $a->skill_id }}_{{ $d }}"
                                                placeholder="Assessment value..."
                                                aria-label="Assessment value..."
                                                aria-describedby="assessment_{{ $a->skill_id }}_{{ $d }}"
                                                value="{{ round($a->assessments[$d]) }}"
                                                readonly/>
                                            <div class="input-group-append">
                                                <span class="input-group-text n-b-r" id="assessment_{{ $a->skill_id }}_{{ $d }}">%</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>    
                                @endforeach
                            </tr>
                            @endforeach
                        @else
                            <tr id="no-data-row">
                                <td class="text-center text-white pt-3 pb-3" colspan="{{ count($dates) + 1 }}">No Skills For Assessment</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Message box -->
<div class="position-fixed bottom-0 right-0 p-3" style="z-index: 99999; left: 50%; top: 0; transform: translateX(-50%);">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header bg-success text-white">
            <strong class="mr-auto">Message</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body bg-white text-secondary">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>