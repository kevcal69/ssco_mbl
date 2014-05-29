var PieChart = {
    drawPieChart: function (slices, id) {
        var percentElements = slices.percentages;
        var colorElements = slices.colors;

        var canvas = document.getElementById(id);
        var context = canvas.getContext("2d");

        var centerX = canvas.width / 2;
        var centerY = canvas.height / 2;
        var radius = 80;

        context.beginPath();
        var endAngle = 2 * Math.PI

        var lastAngle = 0;

        for (var i = 0; i < percentElements.length; i++) {
            var percent = percentElements[i];
            var color = colorElements[i];

            var currentSegment = endAngle * (percent/100);
            var currentAngle = currentSegment + lastAngle;

            context.beginPath();
            context.moveTo(centerX, centerY)
            context.arc(centerX, centerY, radius, lastAngle, currentAngle, false);
            context.closePath();

            lastAngle = lastAngle + currentSegment;

            context.fillStyle = color;
            context.fill();

            if (this.segmentMode) {
                context.lineWidth = 2;
                context.strokeStyle = 'white';

            }else {
                context.lineWidth = 1;
                context.strokeStyle = 'black';

            }
            context.stroke();
            context.fill();
        }
        if (this.segmentMode) {

            context.beginPath();
            context.fillStyle = 'white';
            context.arc(centerX, centerY, radius - 20, 0, 2 * Math.PI, false);
            context.fill();
        }
    }
}
 