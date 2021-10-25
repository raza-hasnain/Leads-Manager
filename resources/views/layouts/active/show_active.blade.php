						
                                     @forelse($activities as $activity)
                                        <li class=activity-purple>
                                            <small class=text-muted>{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</small>
                                            <p class="fs-13 mb-1">{{$activity->description}}</p>
                                             <p class="fs-13 mb-1">{!!$activity->getExtraProperty('item')!!}</p>
                                        </li>
                                         @empty
                                                
                                            @endforelse
                           	