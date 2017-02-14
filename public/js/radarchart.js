var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
    labels: ["Mini Contests", "Team Contests", "Homework", "Problem Bs", "Kattis Sets", "Achievements"],
        datasets: [
            {
                label: topStudentName + "'s Performance",
                backgroundColor: "rgba(179,181,198,0.2)",
                borderColor: "rgba(179,181,198,1)",
                pointBackgroundColor: "rgba(179,181,198,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(179,181,198,1)",
                data: topData
            },
            {
                label: studentName + "'s Performance",
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: data
            }
        ]
    },
    options: {
        scale: {
            reverse: false,
            ticks: {
                beginAtZero: true,
                max: 14
            }
        }
    },
});
