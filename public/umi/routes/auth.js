import Redirect from 'umi/redirect';

export default (props) => {
    let auth = Math.ceil(Math.random() * 100) % 2;
    aut = false;
    console.log(auth);
    return (
        <div>
            {auth ? <Redirect to="/login" /> :
                <div>
                    <div>PrivateRoute (routes/PrivateRoute.js)</div>
                    {props.children}
                </div>}
        </div>
    );
}
