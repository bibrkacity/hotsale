function send_data(){

    let f = document.getElementById('reg');
    let data = {};
    for(let i=0; i< f.elements.length; i++ ){
        let el = f.elements[i];
        data[el.name] = el.value;
    }

    const doAjax = async () => {
        const response = await fetch(submit_url /* defined in auth.reg */, {
            method: 'POST',
                headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const jVal = await response.json();
        if (response.ok) {
            success(f);
        }
        else{
            fail(jVal);
        }

    }
    doAjax().then();
}

function success(f){
    f.remove();
    let main = document.getElementsByTagName('main')[0];
    let h2 = document.createElement('H2');
    h2 = main.appendChild(h2);
    h2.innerText = 'Registration was completed successfully';
}

function fail(jVal){

    let div = document.getElementById('errors');

    div.childNodes.length=0;

    if(typeof jVal.message === 'object'){
        for(let key in jVal.message){
            let p = document.createElement('P');
            p = div.appendChild(p);
            let txt = document.createTextNode(key+': ');
            p.appendChild(txt);

            for( let i=0; i<jVal.message[key].length; i++ ){
                txt = document.createTextNode(jVal.message[key][i]);
                p.appendChild(txt);
                let br = document.createElement('BR');
                p.appendChild(br);

            }

        }
    } else {
        let p = document.createElement('P');
        p = div.appendChild(p);
        p.innerText = jVal.message;
    }

}



