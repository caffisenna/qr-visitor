        @php
            // 結果セットを日付ごとにグループ化
            $groupedResults = $counts->groupBy('date');
        @endphp

        @foreach ($groupedResults as $date => $dateResults)
            <h2>{{ $date }}</h2> <!-- 日付を表示 -->

            <table class="uk-table uk-table-striped uk-table-small">
                <thead>
                    <tr>
                        <th>ブース名</th>
                        <th>〜10時</th>
                        <th>〜11時</th>
                        <th>〜12時</th>
                        <th>〜13時</th>
                        <th>〜14時</th>
                        <th>〜15時</th>
                        <th>〜16時</th>
                        <th>16時〜</th>
                        <th>合計</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $boothTotals = [
                            'H' => [
                                '09:00' => 0,
                                '10:00' => 0,
                                '11:00' => 0,
                                '12:00' => 0,
                                '13:00' => 0,
                                '14:00' => 0,
                                '15:00' => 0,
                                '16:00' => 0,
                                '16:00up' => 0, // 16時以降の合計
                                'total' => 0,
                            ],
                            'K' => [
                                '09:00' => 0,
                                '10:00' => 0,
                                '11:00' => 0,
                                '12:00' => 0,
                                '13:00' => 0,
                                '14:00' => 0,
                                '15:00' => 0,
                                '16:00' => 0,
                                '16:00up' => 0, // 16時以降の合計
                                'total' => 0,
                            ],
                            // 他のブースに関する設定を追加
                            // ...
                            'hourTotals' => [
                                '09:00' => 0,
                                '10:00' => 0,
                                '11:00' => 0,
                                '12:00' => 0,
                                '13:00' => 0,
                                '14:00' => 0,
                                '15:00' => 0,
                                '16:00' => 0,
                                '16:00up' => 0, // 16時以降の合計
                                'total' => 0,
                            ],
                        ];
                    @endphp

                    @foreach ($dateResults as $row)
                        @php
                            $booth = $row->booth_number;
                            $hour = $row->time_interval;
                            $count = $row->count;

                            if (!isset($boothTotals[$booth])) {
                                $boothTotals[$booth] = [
                                    '09:00' => 0,
                                    '10:00' => 0,
                                    '11:00' => 0,
                                    '12:00' => 0,
                                    '13:00' => 0,
                                    '14:00' => 0,
                                    '15:00' => 0,
                                    '16:00' => 0,
                                    '16:00up' => 0, // 16時以降の合計
                                    'total' => 0,
                                ];
                            }

                            $boothTotals[$booth][$hour] += $count;
                            $boothTotals[$booth]['total'] += $count;

                            // 16:00以降のカウンタも更新
                            if ($hour >= '16:00') {
                                $boothTotals[$booth]['16:00up'] += $count;
                            }

                            $boothTotals['hourTotals'][$hour] += $count;
                            $boothTotals['hourTotals']['total'] += $count;
                        @endphp
                    @endforeach

                    {{-- 各ブースごとの16:00以降のカウント --}}
                    @foreach (['H', 'K', 'S', 'E', 'F'] as $booth)
                        <tr>
                            <td>
                                @switch($booth)
                                    @case('H')
                                        販売店
                                    @break

                                    @case('K')
                                        工事店
                                    @break

                                    @case('S')
                                        メーカー
                                    @break

                                    @case('E')
                                        金融・管理・一般・EU
                                    @break

                                    @case('F')
                                        ファシリティーズ
                                    @break

                                    @default
                                        時間帯合計
                                @endswitch
                            </td>
                            <td>{{ $boothTotals[$booth]['09:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['10:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['11:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['12:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['13:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['14:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['15:00'] }}</td>
                            <td>{{ $boothTotals[$booth]['16:00up'] }}</td>
                            <td>{{ $boothTotals[$booth]['total'] }}</td>
                        </tr>
                    @endforeach

                    {{-- 時間帯合計の行 --}}
                    <tr>
                        <td>時間帯合計</td>
                        <td>{{ $boothTotals['hourTotals']['09:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['10:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['11:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['12:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['13:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['14:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['15:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['16:00'] }}</td>
                        <td>{{ $boothTotals['hourTotals']['total'] }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach
