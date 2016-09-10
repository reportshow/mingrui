import React from 'react';
import {Table, TableBody, TableFooter, TableHeader, TableHeaderColumn, TableRow, TableRowColumn} from 'material-ui/Table';
import TextField from 'material-ui/TextField';
import Toggle from 'material-ui/Toggle';

import {deepOrange500} from 'material-ui/styles/colors';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

const muiTheme = getMuiTheme({
    palette: {
	accent1Color: deepOrange500,
    },
});

const styles = {
    propContainer: {
	width: 200,
        overflow: 'hidden',
	margin: '20px auto 0',
    },
    propToggleHeader: {
	margin: '20px auto 10px',
    },
};

export default class TableExampleComplex extends React.Component {
    
    constructor(props) {
	super(props);
	this.state = {
	    ge: '',
	    po: '',
	    ty: '',
	    queryResult: tableData,
	    fixedHeader: true,
	    fixedFooter: true,
	    stripedRows: true,
	    showRowHover: true,
	    selectable: false,
	    multiSelectable: false,
	    enableSelectAll: false,
	    deselectOnClickaway: true,
	    showCheckboxes: false,
	    adjustForCheckboxes: false,
	    height: '300px',
	};	
    }

    handleChange = (event) => {
	var queryResult = [];
	var ge= this.state.ge;
	var po= this.state.po;
	var ty= this.state.ty;
	
	if(event.target.name == 'ge') {
	    this.setState({ge:  event.target.value});
	    ge = event.target.value;
	}

	if(event.target.name == 'po') {
	    this.setState({po:  event.target.value});
	    po = event.target.value;
	}
	
	if(event.target.name == 'ty') {
	    this.setState({ty:  event.target.value});
	    ty = event.target.value;
	}

	tableData.forEach(function(record){
	    if(record[0].toLowerCase().indexOf(ge)!=-1 &&
	       record[1].toLowerCase().indexOf(po)!=-1 &&
	       record[5].toLowerCase().indexOf(ty)!=-1
	      )
		queryResult.push(record);
	});


	this.setState({queryResult: queryResult})
    };

    render() {
	return (
<MuiThemeProvider muiTheme={muiTheme}>
  <div>
    <Table
       height={this.state.height}
       fixedHeader={this.state.fixedHeader}
       fixedFooter={this.state.fixedFooter}
       selectable={this.state.selectable}
       multiSelectable={this.state.multiSelectable}
       >
      <TableHeader
	 displaySelectAll={this.state.showCheckboxes}
	 adjustForCheckbox={this.state.adjustForCheckboxes}
	 enableSelectAll={this.state.enableSelectAll}
	 >
	<TableRow>
	  <TableHeaderColumn colSpan="6" tooltip="诊断过滤工具" style={{textAlign: 'center'}}>
	    Super Header
	  </TableHeaderColumn>
	</TableRow>
	<TableRow>
	  <TableHeaderColumn ><TextField name='ge' floatingLabelText="基因" defaultValue={this.state.ge} fullWidth={true} onChange={this.handleChange}/></TableHeaderColumn>
		<TableHeaderColumn ><TextField name='po' floatingLabelText="突变位置" defaultValue={this.state.po} fullWidth={true} onChange={this.handleChange}/></TableHeaderColumn>
		<TableHeaderColumn ><TextField name='ty' floatingLabelText="突变类型" defaultValue={this.state.ty} fullWidth={true} onChange={this.handleChange}/></TableHeaderColumn>
	</TableRow>
	<TableRow>
	  <TableHeaderColumn tooltip="基因">基因</TableHeaderColumn>
	  <TableHeaderColumn tooltip="突变位置">突变位置</TableHeaderColumn>
	  <TableHeaderColumn tooltip="突变类型">突变类型</TableHeaderColumn>
	  <TableHeaderColumn tooltip="千人基因组">千人基因组</TableHeaderColumn>
	  <TableHeaderColumn tooltip="欧洲6500">欧洲6500</TableHeaderColumn>
	  <TableHeaderColumn tooltip="inhouse">inhouse</TableHeaderColumn>
	</TableRow>
      </TableHeader>
      <TableBody
	 displayRowCheckbox={this.state.showCheckboxes}
	 deselectOnClickaway={this.state.deselectOnClickaway}
	 showRowHover={this.state.showRowHover}
	 stripedRows={this.state.stripedRows}
	 >
	{this.state.queryResult.map( (row, index) => (
	<TableRow key={index} selected={row.selected}>
	  <TableRowColumn>{row[0]}</TableRowColumn>
	  <TableRowColumn>{row[1]}</TableRowColumn>
	  <TableRowColumn>{row[5]}</TableRowColumn>
	  <TableRowColumn>{row[6][0]}</TableRowColumn>
	  <TableRowColumn>{row[6][1]}</TableRowColumn>
	  <TableRowColumn>{row[6][2]}</TableRowColumn>
	</TableRow>
	))}
      </TableBody>
      <TableFooter
	 adjustForCheckbox={this.state.adjustForCheckboxes}
	 >
	<TableRow>
	  <TableRowColumn>ID</TableRowColumn>
	  <TableRowColumn>Name</TableRowColumn>
	  <TableRowColumn>Status</TableRowColumn>
	</TableRow>
	<TableRow>
	  <TableRowColumn colSpan="6" style={{textAlign: 'center'}}>
	    Super Footer
	  </TableRowColumn>
	</TableRow>
      </TableFooter>
    </Table>
  </div>
</MuiThemeProvider>
	);
    }
}
