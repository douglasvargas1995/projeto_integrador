function MyMap()
{
    this.init = function(options){
        this.containerId = options.containerId;
        this.fieldId = options.fieldId;
        this.latitude = options.latitude;
        this.longitude = options.longitude;
        this.zoom = options.zoom ?? 10;
        this.name = options.name;
        MyMap.instances[this.name] = this;
    }
    this.render = function(){
        var that = this;
        if(!$('#'+that.containerId).is(':visible'))
        {
            setTimeout(function(){
                that.render();
            },250)
            return false;
        }
        this.map = L.map(that.containerId).setView([this.latitude, this.longitude], this.zoom);
        L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a','b','c']
        }).addTo(this.map);
        var marker = new L.marker([this.latitude,this.longitude],{
            draggable: true,
            autoPan: true
        }).addTo(this.map);
        marker.on('dragend', function(e,b){
            var latLong = {
                latitude: e.target._latlng.lat,
                longitude: e.target._latlng.lng
            };
            document.getElementById(that.fieldId).value = JSON.stringify(latLong);
        });
    };
}
MyMap.instances = [];