 

                        <tr>
                        @if((($rea/$previ)*100)>100)
                            @php
                                $r =$previ - $rea;
                                $ttRea  = $ttRea + $rea;
                                $ttPrevi = $ttPrevi + $previ;
                                $ttreliq= $ttreliq +$r;

                                if($previ != 0)
                                {
                                    $ttTaux = $ttTaux + (($rea/$previ)*100);
                                }else
                                {
                                    dd($previ);
                                }

                            @endphp

                            <th >{{ $i++  }}</th>
                            <td>{{ $p->numCompte }}</td>
                            <td>{{ $p->intitulePost }}</td>
                            <td>{{ number_format($previ,2, ',', ' ')  }}</td>
                            <td>{{ number_format($rea,2, ',', ' ') }}</td>
                            <td>{{ number_format($r,2, ',', ' ')  }}</td>
                            <td>{{ number_format(($rea/$previ)*100,2, ',', ' ') }} %</td>
                          @endif
                        </tr>
                      