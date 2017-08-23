<link rel="stylesheet" href="{{ URL::asset('css/jquery.treeview.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/screen.css') }}" />

<script src="{{ URL::asset('jquery/jquery.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('jquery/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('jquery/jquery.treeview.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $("#tree").treeview({
            collapsed: true,
            animated: "fast",
            control:"#sidetreecontrol",
            prerendered: true,
            persist: "location"
        });
    })
</script>

<style>
    a:link{text-decoration:none ; color:black ;}
    a:visited {text-decoration:none ; color:black;}
    a:hover {text-decoration:underline ; color:black;}
    a:active {text-decoration:none ; color:black;}
    #main { width:15%; float:left;}
    #content {width:80%; padding: 1em;}
    #loginifo {float:right; font-size: 12px;}
</style>

<body>
<h1 id="banner">Jackpush Demo <div id="loginifo"> 管理员：{{$turename}} | <a href="{{url('/password')}}">修改密码</a> | <a href="{{url('/logout')}}">退出</a> </div></h1>
<div id="main"> <a href="{{url('/')}}">功能菜单</a>
    <div id="sidetree">
        <div class="treeheader">&nbsp;</div>
        <div id="sidetreecontrol"> <a href="?#">全部折叠</a> | <a href="?#">全部展开</a> </div>
        <ul class="treeview" id="tree">
            <li class="expandable">
                <div class="hitarea expandable-hitarea"></div>
                <span>代码管理</span>
                <ul style="display: none;">
                <!-- foreach start -->
                {!! $str !!}
                <!-- foreach sotp -->
                </ul>
            </li>
            <li class="expandable">
                <div class="hitarea expandable-hitarea"></div>
                <span>News</span>
                <ul style="display: none;">
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/enewsletters/index.cfm">Airdrie eNewsletters</a>
                        <ul style="display: none;">
                            <li><a href="?http://www.industrymailout.com/Industry/View.aspx?id=50169&amp;p=679b" target="_new">Airdrie Today eNewsletter</a></li>
                            <li><a href="?http://www.industrymailout.com/Industry/View.aspx?id=47265&amp;q=0&amp;qz=4c4af0" target="_new">Airdrie @Work eNewsletter</a></li>
                            <li class="last"><a href="?http://www.industrymailout.com/Industry/Archives.aspx?m=2682&amp;qz=73249dbb" target="_new">Airdrie eNewsletter Archive</a></li>
                        </ul>
                    </li>
                    <li><a href="?/calendars/index.cfm">Community Calendar</a></li>
                    <li><a href="?/community_news/index.cfm">Community News</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/news_release/index.cfm">News Releases</a> (2007)
                        <ul style="display: none;">
                            <li><a href="?/news_release/2006/index.cfm" title="2006 News Releases">2006 News Releases</a></li>
                            <li><a href="?/news_release/2005/index.cfm" title="2005 News Releases">2005 News Releases</a></li>
                            <li class="last"><a href="?/news_release/2004/index.cfm" title="2004 News Releases">2004 News Releases</a></li>
                        </ul>
                    </li>
                    <li><a href="?/building_development/planning/notice_of_development/notice_of_development.cfm">Notice of Development </a></li>
                    <li><a href="?/photogallery/index.cfm">Photo Gallery</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/public_meetings/index.cfm">Public Meetings</a>
                        <ul style="display: none;">
                            <li><a href="?/public_meetings/appeals/index.cfm">Appeals</a></li>
                            <li><a href="?/public_meetings/open_houses/index.cfm">Open Houses</a></li>
                            <li class="last"><a href="?/public_meetings/public_hearings/index.cfm">Public Hearings</a></li>
                        </ul>
                    </li>
                    <li class="expandable lastExpandable">
                        <div class="hitarea expandable-hitarea lastExpandable-hitarea"></div>
                        <a href="?/publications/index.cfm">Publications</a>
                        <ul style="display: none;">
                            <li><a href="?/publications/pdf/AirdrieLIFE_fall2006.pdf">Airdrie Life Magazine</a> (16MB, .PDF)</li>
                            <li><a href="?/publications/pdf/report_for_2005.pdf">Annual Economic Report</a> (5 MB, .PDF)</li>
                            <li class="last"><a href="?/publications/pdf/Airdrie%20community%20report%20for%202006_sm.pdf">Annual Community Report</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="expandable">
                <div class="hitarea expandable-hitarea"></div>
                <span>City Council &amp; Administration </span>
                <ul style="display: none;">
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/election/index.cfm">2007 Election</a>
                        <ul style="display: none;">
                            <li><a href="?/election/city_council.cfm" title="City Council">City Council</a></li>
                            <li><a href="?/election/candidates.cfm" title="Candidates">Candidates</a></li>
                            <li><a href="?/election/candidate_information_package.cfm" title="Candidate Information Package">Candidate Information Package</a></li>
                            <li><a href="?/election/faq.cfm" title="Frequently Asked Questions">Frequently Asked Questions</a></li>
                            <li><a href="?/election/how_to_vote.cfm" title="How to Vote">How to Vote</a></li>
                            <li><a href="?/election/media.cfm" title="Media">Media</a></li>
                            <li class="last"><a href="?/election/past_elections.cfm" title="Past Elections">Past Elections</a></li>
                        </ul>
                    </li>
                    <li><a href="?/finance/budget_at_a_glance.cfm">Budget</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/city_council/bylaws/index.cfm">Bylaws</a>
                        <ul style="display: none;">
                            <li><a href="?/city_council/bylaws/how_bylaws_are_passed.cfm">How Bylaws Are Passed</a></li>
                            <li><a href="?/city_council/bylaws/new_laws.cfm">New Laws</a></li>
                            <li class="last"><a href="?/city_council/policies.cfm">Policies</a></li>
                        </ul>
                    </li>
                    <li><a href="?/economic_development/census/index.cfm">Census</a></li>
                    <li class="last"><a href="?/city_council/index.cfm">City Council</a></li>
                </ul>
                <ul style="display: none;">
                    <li><a href="?/city_council/board_appointments.cfm">Board Appointments</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/city_council/committees_boards_commission.cfm">Committees / Boards / Commssion</a>
                        <ul style="display: none;">
                            <li><a href="?/city_council/library_board.cfm" title="Airdrie Municipal Library Board">Airdrie Municipal Library Board</a></li>
                            <li><a href="?/city_council/assessment_review_board.cfm" title="Assessment Review Board">Assessment Review Board</a></li>
                            <li><a href="?/city_council/community_service_advisory_board.cfm" title="Community Services Advisory Board">Community Services Advisory Board</a></li>
                            <li><a href="?/city_council/enviromental_advisory_board.cfm" title="Environmental Advisory Board">Environmental Advisory Board</a></li>
                            <li><a href="?/city_council/finance_committee.cfm" title="Finance Advisory Committee">Finance Advisory Committee</a></li>
                            <li><a href="?/city_council/municipal_planning_commission.cfm" title="Municipal Planning Commission">Municipal Planning Commission</a></li>
                            <li><a href="?/city_council/municipal_police_committee.cfm" title="Municipal Police Committee">Municipal Police Committee</a></li>
                            <li class="last"><a href="?/city_council/subdivision_development_appeal_board.cfm" title="Subdivision and Development Appeal Board">Subdivision and Development Appeal Board</a></li>
                        </ul>
                    </li>
                    <li><a href="?/city_council/faq.cfm">Frequently Asked Questions (FAQ's)</a></li>
                    <li><a href="?/city_council/mayors_message.cfm">Mayor's Message</a></li>
                    <li><a href="?/city_council/mission_vision.cfm">Mission and Vision</a></li>
                    <li><a href="?/city_council/meet_your_council.cfm">Meet Your Council</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/city_council/strategic_priorities.cfm">Strategic Priorities</a>
                        <ul style="display: none;">
                            <li><a href="?/city_council/strategic_priorities.cfm" title="Strategic Priorities 2008">Strategic Priorities 2008</a></li>
                            <li><a href="?/city_council/strategic_priorities_07.cfm" title="Strategic Priorities 2007">Strategic Priorities 2007</a></li>
                            <li><a href="?/city_council/strategic_priorities_06.cfm" title="Strategic Priorities 2006">Strategic Priorities 2006</a></li>
                            <li><a href="?/city_council/strategic_priorities_05.cfm" title="Strategic Priorities 2005">Strategic Priorities 2005</a></li>
                            <li class="last"><a href="?/city_council/strategic_priorities_04.cfm" title="Strategic Priorities 2004">Strategic Priorities 2004</a></li>
                        </ul>
                    </li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/city_council/city_council_meetings.cfm">City Council Meetings</a>
                        <ul style="display: none;">
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a href="?/city_council/agendas/2007_agendas.cfm">City Council Meeting Agendas</a>
                                <ul style="display: none;">
                                    <li><a href="?/city_council/agendas/2007_agendas.cfm" title="2007 Agendas">2007 City Council Meeting Agendas</a></li>
                                    <li><a href="?/city_council/agendas/2006_agendas.cfm" title="2006 Agendas">2006 City Council Meeting Agendas</a></li>
                                    <li><a href="?/city_council/agendas/2005_agendas.cfm" title="2005 Agendas">2005 City Council Meeting Agendas</a></li>
                                    <li class="last"><a href="?/city_council/agendas/2004_agendas.cfm" title="2004 Agendas">2004 City Council Meeting Agendas</a></li>
                                </ul>
                            </li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a href="?/city_council/minutes/2007_minutes.cfm">City Council Meeting Minutes</a>
                                <ul style="display: none;">
                                    <li><a href="?/city_council/minutes/2007_minutes.cfm" title="2007 City Council Meeting Minutes">2007 City Council Meeting Minutes</a></li>
                                    <li><a href="?/city_council/minutes/2006_minutes.cfm" title="2006 City Council Meeting Minutes">2006 City Council Meeting Minutes</a></li>
                                    <li><a href="?/city_council/minutes/2005_minutes.cfm" title="2005 City Council Meeting Minutes">2005 City Council Meeting Minutes</a></li>
                                    <li class="last"><a href="?/city_council/minutes/2004_minutes.cfm" title="2004 City Council Meeting Minutes">2004 City Council Meeting Minutes</a></li>
                                </ul>
                            </li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a href="?/city_council/synopsis/2007_synopsis.cfm">City Council Meeting Synopsis</a>
                                <ul style="display: none;">
                                    <li><a href="?/city_council/synopsis/2007_synopsis.cfm" title="2007 City Council Meeting Synopsis">2007 City Council Meeting Synopsis</a></li>
                                    <li><a href="?/city_council/synopsis/2006_synopsis.cfm" title="2006 City Council Meeting Synopsis">2006 City Council Meeting Synopsis</a></li>
                                    <li><a href="?/city_council/synopsis/2005_synopsis.cfm" title="2005 City Council Meeting Synopsis">2005 City Council Meeting Synopsis</a></li>
                                    <li class="last"><a href="?/city_council/synopsis/2004_synopsis.cfm" title="2004 City Council Meeting Synopsis">2004 City Council Meeting Synopsis</a></li>
                                </ul>
                            </li>
                            <li class="last"><a href="?/city_council/how_to_go_to_council.cfm">How to Go to Council</a></li>
                        </ul>
                    </li>
                    <li><a href="?/city_council/foip.cfm">FOIP</a></li>
                    <li><a href="?/city_council/how_government_works.cfm">How Government Works</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/city_council/legislative_admin_services.cfm">Legislative &amp; Admin Services</a>
                        <ul style="display: none;">
                            <li class="last"><a href="?/city_council/city_managers_message.cfm">City Manager's Message</a></li>
                        </ul>
                    </li>
                    <li class="last"><a href="?/org_chart/index.cfm">Organizational Chart</a></li>
                </ul>
            </li>
            <li class="expandable">
                <div class="hitarea expandable-hitarea"></div>
                <a href="?lifestyle">Lifestyle</a>
                <ul style="display: none;">
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/about_airdrie/index.cfm">About Airdrie</a>
                        <ul style="display: none;">
                            <li class="last"><a href="?/about_airdrie/history.cfm">History</a></li>
                        </ul>
                    </li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/arts_culture/index.cfm">Arts &amp; Culture</a>
                        <ul style="display: none;">
                            <li><a href="?/arts_culture/airdrie_art.cfm">Airdrie Art</a></li>
                            <li><a href="?http://www.airdriepubliclibrary.ca/" target="_new">Airdrie Public Library</a></li>
                            <li><a href="?/arts_culture/airdrie_rodeo_ranch.cfm">Airdrie Rodeo Ranch</a></li>
                            <li><a href="?/twinning_program/index.cfm">Korean Twinning Program</a></li>
                            <li><a href="?/arts_culture/little_theatre_association.cfm">Little Theatre Association</a></li>
                            <li><a href="?/sport_community_facilities/nose_creek_valley_museum.cfm" target="_new">Nose Creek Valley Museum</a></li>
                            <li class="last"><a href="?http://www.rockyview.ab.ca/rvae/" target="_new">Rocky View Adult Education</a></li>
                        </ul>
                    </li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/bert_church_theatre/index.cfm">Bert Church LIVE Theatre</a>
                        <ul style="display: none;">
                            <li><a href="?/bert_church_theatre/about_us.cfm" title="About Us">About Us</a></li>
                            <li><a href="?/bert_church_theatre/season_program.cfm" title="Current Season Program">Current Season Program</a></li>
                            <li><a href="?/bert_church_theatre/box_office.cfm" title="Box Office">Box Office</a></li>
                            <li><a href="?/bert_church_theatre/theatre_rental.cfm" title="Theatre Rental">Theatre Rental</a></li>
                            <li><a href="?/bert_church_theatre/technical_specifications.cfm" title="Technical Specifications">Technical Specifications</a></li>
                            <li><a href="?/bert_church_theatre/contact_us.cfm" title="Contact Us">Contact Us</a></li>
                            <li><a href="?/bert_church_theatre/photogallery.cfm" title="Photo Gallery">Photo Gallery</a></li>
                            <li><a href="?/bert_church_theatre/links.cfm" title="Links">Links</a></li>
                            <li class="last"><a href="?http://www.theresawasden.com/music_in_common.htm" target="_blank" title="Performing Arts Classes">Performing Arts Classes</a></li>
                        </ul>
                    </li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/elrwc/index.cfm">East Lake Recreation &amp; Wellness Centre</a>
                        <ul style="display: none;">
                            <li><a href="?/elrwc/about_facility.cfm" title="About the Facility">About the Facility</a></li>
                            <li><a href="?/elrwc/contact.cfm" title="Contact Us">Contact Us</a></li>
                            <li><a href="?/elrwc/forms.cfm" title="Forms">Forms</a></li>
                            <li><a href="?/elrwc/future_phases.cfm" title="Future Phases">Future Phases</a></li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a href="?/elrwc/hours_operation.cfm" title="Hours of Operation &amp; Schedules">Hours of Operation &amp; Schedules</a>
                                <ul style="display: none;">
                                    <li class="last"><a href="?/elrwc/schedules.cfm">Schedules</a></li>
                                </ul>
                            </li>
                            <li><a href="?/elrwc/city_guide.cfm" title="In the City Guide">In the City Guide</a></li>
                            <li><a href="?/elrwc/opportunities_events.cfm" title="Opportunities &amp; Events">Opportunities &amp; Events</a></li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a href="?/elrwc/programs_services.cfm" title="Programs &amp; Services">Programs &amp; Services</a>
                                <ul style="display: none;">
                                    <li class="expandable">
                                        <div class="hitarea expandable-hitarea"></div>
                                        <a title="Aquatics" href="?/elrwc/aquatics.cfm">Aquatics</a>
                                        <ul style="display: none;">
                                            <li class="last"><a title="Water Drop-in Classes" href="?/elrwc/water_classes.cfm">Water Drop-in Classes</a></li>
                                        </ul>
                                    </li>
                                    <li><a title="Child Care Services" href="?/elrwc/child_services.cfm">Child Care Services</a></li>
                                    <li><a title="Children Activities" href="?/elrwc/children_activities.cfm">Children Activities</a></li>
                                    <li class="expandable">
                                        <div class="hitarea expandable-hitarea"></div>
                                        <a title="Fitness &amp; Wellness" href="?/elrwc/fitness_wellness.cfm">Fitness &amp; Wellness</a>
                                        <ul style="display: none;">
                                            <li><a title="Dry Land Drop-in Classes" href="?/elrwc/land_classes.cfm">Dry Land Drop-in Classes</a></li>
                                            <li class="last"><a title="Fitness &amp; Wellness Services" href="?/elrwc/fitness_wellness_services.cfm">Fitness &amp; Wellness Services</a></li>
                                        </ul>
                                    </li>
                                    <li><a title="Party Packages" href="?/elrwc/party_packages.cfm">Party Packages</a></li>
                                    <li class="last"><a title="Room Rentals" href="?/elrwc/room_rentals.cfm">Room Rentals</a></li>
                                </ul>
                            </li>
                            <li><a href="?/elrwc/rates_fees.cfm" title="Rates &amp; Fees">Rates &amp; Fees</a></li>
                            <li class="last"><a href="?/elrwc/register_now.cfm" title="Register Now">Register Now</a></li>
                        </ul>
                    </li>
                    <li><a href="?/education/index.cfm">Education</a></li>
                    <li><a href="?/health/index.cfm">Health</a></li>
                    <li><a href="?/gis/index.cfm">Maps (GIS)</a></li>
                    <li><a href="?/parks/parks_recreation.cfm">Parks &amp; Recreation</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a title="Parks" href="?/parks/index.cfm">Parks</a>
                        <ul style="display: none;">
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a title="City Parks Programs" href="?city_parks_programs.cfm">City Parks Programs</a>
                                <ul style="display: none;">
                                    <li><a href="?airdrie_horticulture_society.cfm" title="Airdrie Horticulture Society">Airdrie Horticulture Society</a></li>
                                    <li><a href="?communities_in_bloom.cfm" title="Communities in Bloom">Communities in Bloom</a></li>
                                    <li><a href="?community_garden.cfm" title="Community Garden">Community Garden</a></li>
                                    <li class="last"><a href="?landscape_awards_program.cfm" title="Landscape Awards Program">Landscape Awards Program</a></li>
                                </ul>
                            </li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a title="Maintenance" href="?maintenance.cfm">Maintenance</a>
                                <ul style="display: none;">
                                    <li><a href="?dandelions.cfm" title="Dandelions">Dandelions</a></li>
                                    <li><a href="?gophers.cfm" title="Gophers">Gophers</a></li>
                                    <li><a href="?grass_cutting.cfm" title="Grass Cutting">Grass Cutting</a></li>
                                    <li class="last"><a href="?pathway_snow_removal.cfm" title="Pathway Snow Removal">Pathway Snow Removal</a></li>
                                </ul>
                            </li>
                            <li><a title="Maps" href="?/gis/index.cfm">Maps</a></li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a title="Outdoor Facilities" href="?outdoor_facilities.cfm">Outdoor Facilities</a>
                                <ul style="display: none;">
                                    <li><a title="Ball Diamonds" href="?ball_diamonds.cfm">Ball Diamonds</a></li>
                                    <li><a title="BMX Track" href="?bmx_track.cfm">BMX Track</a></li>
                                    <li><a title="Bookings" href="?bookings.cfm">Bookings</a></li>
                                    <li><a title="Cemetery" href="?cemetery.cfm">Cemetery</a></li>
                                    <li><a title="Fire Pits" href="?fire_pits.cfm">Fire Pits</a></li>
                                    <li><a title="Gwacheon Park" href="?/twinning_program/index.cfm#gwacheon">Gwacheon Park</a></li>
                                    <li><a title="Off-Leash Areas" href="?off_leash_areas.cfm">Off-Leash Areas</a></li>
                                    <li><a title="Outdoor Rinks" href="?outdoor_rinks.cfm">Outdoor Rinks</a></li>
                                    <li><a title="Parks &amp; Playgrounds" href="?parks_playgrounds.cfm">Parks &amp; Playgrounds</a></li>
                                    <li><a title="Skate Park" href="?skate_park.cfm">Skate Park</a></li>
                                    <li><a title="Soccer/Athletic Fields" href="?soccer_athletic_fields.cfm">Soccer/Athletic Fields</a></li>
                                    <li><a title="Splash Park" href="?splash_park.cfm">Splash Park</a></li>
                                    <li class="last"><a title="Tennis Courts" href="?tennis_courts.cfm">Tennis Courts</a></li>
                                </ul>
                            </li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a title="Parks Planning &amp; Construction" href="?parks_planning_construction.cfm">Parks Planning &amp; Construction</a>
                                <ul style="display: none;">
                                    <li><a href="?construction.cfm" title="Construction">Construction</a></li>
                                    <li class="last"><a href="?plans.cfm" title="Plans">Plans</a></li>
                                </ul>
                            </li>
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a title="Urban Forest" href="?urban_forest.cfm">Urban Forest</a>
                                <ul style="display: none;">
                                    <li><a href="?city_trees.cfm" title="City Trees">City Trees</a></li>
                                    <li class="last"><a href="?tree_planting.cfm" title="Tree Planting">Tree Planting</a></li>
                                </ul>
                            </li>
                            <li class="expandable lastExpandable">
                                <div class="hitarea expandable-hitarea lastExpandable-hitarea"></div>
                                <a title="Weeds &amp; Pests" href="?weeds_pests.cfm">Weeds &amp; Pests</a>
                                <ul style="display: none;">
                                    <li><a href="?mosquito_control.cfm" title="Mosquito Control">Mosquito Control</a></li>
                                    <li><a href="?pest_control.cfm" title="Pest Control">Pest Control</a></li>
                                    <li class="last"><a href="?weed_control_plant_disease.cfm" title="Weed Control &amp; Plant Disease">Weed Control &amp; Plant Disease</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="expandable lastExpandable">
                        <div class="hitarea expandable-hitarea lastExpandable-hitarea"></div>
                        <a title="Sport &amp; Community Facilities" href="?/sport_community_facilities/index.cfm">Sport &amp; Community Facilities</a>
                        <ul style="display: none;">
                            <li class="expandable">
                                <div class="hitarea expandable-hitarea"></div>
                                <a title="Indoor Facilities" href="?/sport_community_facilities/indoor_facilities.cfm">Indoor Facilities</a>
                                <ul style="display: none;">
                                    <li><a title="Arenas/Gymnastics" href="?/sport_community_facilities/arenas_gymnastics.cfm">Arenas/Gymnastics</a></li>
                                    <li><a title="Curling Rink" href="?/sport_community_facilities/curling_rink.cfm">Curling Rink</a></li>
                                    <li><a title="East Lake Recreation &amp; Wellness Centre" href="?/elrwc/index.cfm">East Lake Recreation &amp; Wellness Centre</a></li>
                                    <li><a title="Nose Creek Valley Museum" href="?/sport_community_facilities/nose_creek_valley_museum.cfm">Nose Creek Valley Museum</a></li>
                                    <li><a title="Over 50 Club" href="?/sport_community_facilities/over_50_club.cfm">Over 50 Club</a></li>
                                    <li class="last"><a title="Town &amp; Country" href="?/sport_community_facilities/town_country.cfm">Town &amp; Country</a></li>
                                </ul>
                            </li>
                            <li class="last"><a title="Outdoor Facilities" href="?/parks/outdoor_facilities.cfm">Outdoor Facilities</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="expandable">
                <div class="hitarea expandable-hitarea"></div>
                <a href="?visiting">Visiting</a>
                <ul style="display: none;">
                    <li><a href="?/gis/recreation_map/index.cfm">Community Map</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/events/index.cfm">Events</a>
                        <ul style="display: none;">
                            <li><a href="?http://www.airdriefestivaloflights.com" target="_new">Airdrie Festival of Lights</a></li>
                            <li><a href="?http://www.airdrieprorodeo.net/" target="_new">Airdrie Pro Rodeo</a></li>
                            <li class="last"><a href="?http://www.pch.gc.ca/special/canada/index_e.cfm" target="_new">Canada Day</a></li>
                        </ul>
                    </li>
                    <li><a href="?/parks/parks_recreation.cfm">Parks &amp; Recreation</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/economic_development/tourist_information/tourist_information.cfm">Tourist Information</a>
                        <ul style="display: none;">
                            <li><a href="?/economic_development/entertainment/entertainment.cfm">Entertainment</a></li>
                            <li><a href="?/economic_development/hotels/hotels.cfm">Hotels</a></li>
                            <li><a href="?/economic_development/restaurants/restaurants.cfm">Restaurants</a></li>
                            <li><a href="?/economic_development/shopping/shopping.cfm">Shopping</a></li>
                            <li class="last"><a href="?http://www1.travelalberta.com/en-ab/index.cfm?country=CA&amp;state=AB&amp;setlocale=1" target="_new">Travel Alberta</a></li>
                        </ul>
                    </li>
                    <li class="last"><a href="?http://www.woodsidegc.com/contact.html" target="_new">Woodside Golf Course</a></li>
                </ul>
            </li>
            <li class="expandable">
                <div class="hitarea expandable-hitarea"></div>
                <a href="?/economic_development/index.cfm">Doing Business</a>
                <ul style="display: none;">
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/economic_development/business_attraction/index.cfm">Business Attraction</a>
                        <ul style="display: none;">
                            <li><a href="?http://www.albertafirst.com/profiles/statspack/20365.html" target="_new">Airdrie Profile</a></li>
                            <li><a href="?/economic_development/business_attraction/business_case.cfm">Business Case For Airdrie</a></li>
                            <li><a href="?/economic_development/census/index.cfm">Census Data </a></li>
                            <li><a href="?http://www.albertafirst.com/realestate/" target="_new">Properties and Businesses For Sale</a></li>
                            <li class="last"><a href="?/taxation/non_residential_comparisons.cfm">Taxation</a></li>
                        </ul>
                    </li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/economic_development/business_development/index.cfm">Business Development</a>
                        <ul style="display: none;">
                            <li><a href="?/economic_development/business_development/business_associations.cfm">Business Associations</a></li>
                            <li><a href="?/economic_development/business_development/business_resources.cfm">Business Resources</a></li>
                            <li><a href="?/economic_development/business_development/business_services.cfm">Business Services</a></li>
                            <li><a href="?/corporate_properties/index.cfm">Corporate Properties</a></li>
                            <li class="last"><a href="?/economic_development/business_development/home_businesses.cfm">Home Based Businesses</a></li>
                        </ul>
                    </li>
                    <li><a href="?/directories/business_directory/index.cfm">Business Directory</a></li>
                    <li class="expandable">
                        <div class="hitarea expandable-hitarea"></div>
                        <a href="?/economic_development/business_licenses/index.cfm">Business Licenses</a>
                        <ul style="display: none;">
                            <li><a href="?/economic_development/business_licenses/municipal_licenses_permits.cfm">Municipal Licenses &amp; Permits</a></li>
                            <li><a href="?/economic_development/business_licenses/provincial_licenses_permits.cfm">Provincial Licenses &amp; Permits</a></li>
                            <li class="last"><a href="?/economic_development/business_licenses/registry_services.cfm">Registry Services</a></li>
                        </ul>
                    </li>
                    <li><a href="?http://bsa.canadabusiness.ca/gol/bsa/site.nsf/en/index.html" target="_new">How to Start a Business</a></li>
                    <li class="last"><a href="?/finance/procurement_services.cfm">Procurement Services</a></li>
                </ul>
            </li>
            <li class="last"><a href="?https://vch.airdrie.ca/index.cfm">Online Services</a></li>
        </ul>
    </div>
</div>
@yield('content')
</body>