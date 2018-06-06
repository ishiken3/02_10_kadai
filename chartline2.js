//チャートJS 線グラフ
        var kenichi = <?php echo json_encode($result_c_k['kenichi']); ?>;
        var yujiro = <?php echo json_encode($result_c_y['yujiro']); ?>;
        var satomi = <?php echo json_encode($result_c_s['satomi']); ?>;
        var yoshiko = <?php echo json_encode($result_c_o['yoshiko']); ?>;
 
        //折れ線グラフ2
var ctx = document.getElementById("myLine2Chart");
var myLine2Chart = new Chart(ctx, {
  //グラフの種類
  type: 'line',
  //データの設定
  data: {
      //データ項目のラベル
      labels: ["1月", "2月", "3月", "4月", "5月", "6月"],
      //データセット
      datasets: [
          {
              //凡例
              label: "1年目",
              //面の表示
              fill: false,
              //線のカーブ
              lineTension: 0,
              //背景色
              backgroundColor: "rgba(179,181,198,0.2)",
              //枠線の色
              borderColor: "rgba(179,181,198,1)",
              //結合点の枠線の色
              pointBorderColor: "rgba(179,181,198,1)",
              //結合点の背景色
              pointBackgroundColor: "#fff",
              //結合点のサイズ
              pointRadius: 5,
              //結合点のサイズ（ホバーしたとき）
              pointHoverRadius: 8,
              //結合点の背景色（ホバーしたとき）
              pointHoverBackgroundColor: "rgba(179,181,198,1)",
              //結合点の枠線の色（ホバーしたとき）
              pointHoverBorderColor: "rgba(220,220,220,1)",
              //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
              pointHitRadius: 15,
              //グラフのデータ
              data: [12, 19, 3, 5, 2, 3]
          },
          {
              //凡例
              label: "2年目",
              //面の表示
              fill: false,
              //線のカーブ
              lineTension: 0,
              //背景色
              backgroundColor: "rgba(75,192,192,0.4)",
              //枠線の色
              borderColor: "rgba(75,192,192,1)",
              //結合点の枠線の色
              pointBorderColor: "rgba(75,192,192,1)",
              //結合点の背景色
              pointBackgroundColor: "#fff",
              //結合点のサイズ
              pointRadius: 5,
              //結合点のサイズ（ホバーしたとき）
              pointHoverRadius: 8,
              //結合点の背景色（ホバーしたとき）
              pointHoverBackgroundColor: "rgba(75,192,192,1)",
              //結合点の枠線の色（ホバーしたとき）
              pointHoverBorderColor: "rgba(220,220,220,1)",
              //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
              pointHitRadius: 10,
              //グラフのデータ
              data: [15, 15, 6, 8, 5, 6]
          }
      ]
  },
  //オプションの設定
  options: {
      //軸の設定
      scales: {
          //縦軸の設定
          yAxes: [{
              //目盛りの設定
              ticks: {
                  //最小値を0にする
                  beginAtZero: true
              }
          }]
      },
      //ホバーの設定
      hover: {
          //ホバー時の動作（single, label, dataset）
          mode: 'single'
      }
  }
});