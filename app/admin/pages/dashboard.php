<div class="w-full h-full min-w-[600px] min-h-[300px]">
    <div id="barChart"></div>
</div>

<script>
    $(document).ready(function() {
        var data = [{
                year: 2024,
                month: 1,
                day: 1,
                income: 5000,
                expense: 3000
            },
            {
                year: 2024,
                month: 2,
                day: 1,
                income: 6000,
                expense: 3500
            },
            {
                year: 2024,
                month: 3,
                day: 1,
                income: 4500,
                expense: 4000
            },
            {
                year: 2024,
                month: 4,
                day: 1,
                income: 7000,
                expense: 3800
            },
            {
                year: 2024,
                month: 5,
                day: 1,
                income: 5500,
                expense: 4200
            }
        ];

        renderBarChart(data);

        function renderBarChart(data) {
            var {
                BarChart,
                Bar,
                XAxis,
                YAxis,
                CartesianGrid,
                Tooltip,
                Legend
            } = Recharts;

            var container = document.createElement('div');

            ReactDOM.render(
                React.createElement(BarChart, {
                        width: 600,
                        height: 300,
                        data: data,
                        margin: {
                            top: 20,
                            right: 30,
                            left: 20,
                            bottom: 5
                        }
                    },
                    React.createElement(CartesianGrid, {
                        strokeDasharray: "3 3"
                    }),
                    React.createElement(XAxis, {
                        dataKey: (data) => `${data.year}-${data.month}-${data.day || 1}`
                    }),
                    React.createElement(YAxis, {}),
                    React.createElement(Tooltip, {}),
                    React.createElement(Legend, {}),
                    React.createElement(Bar, {
                        dataKey: "income",
                        fill: "#10B981"
                    }),
                    React.createElement(Bar, {
                        dataKey: "expense",
                        fill: "#ef4444"
                    })
                ),
                container
            );

            document.getElementById('barChart').appendChild(container);
        }
    });
</script>